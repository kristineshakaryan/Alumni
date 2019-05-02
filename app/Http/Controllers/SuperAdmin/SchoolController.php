<?php

namespace App\Http\Controllers\SuperAdmin;

use App\SchoolOfTheUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DegreeOfTheSchool;
use App\SurveyOfTheSchool;
use App\AdminOfTheSchool;
use App\SchoolOfTheGroup;
use App\JobOfTheUser;
use Carbon\Carbon;
use App\School;
use App\Degree;
use App\User;
use Crypt;
use Mail;


class SchoolController extends Controller
{
    //
    public function NewClient(){
        return view('super_admin.school.newschool');
    }
    // Send Recap Mail
    public function SendMailNewsletter(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $user = User::find($id);
        $data = [];
        Mail::send(['html' => 'mail.recap_mail'], $data, function ($message) use($user) {
            $message->from('kristineshakaryan@gmail.com', 'alumni');
            $message->to($user->email)->subject('Recap');
        });

    }
    // Add Sruvey To School
    public function AddSurveyToSchool(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $SurveyOfTheSchool = SurveyOfTheSchool::where('survey_id' , request('survey_add') )->where('school_id',$id)->first();
        if(!$SurveyOfTheSchool) {
            $SurveyOfTheSchool = new SurveyOfTheSchool();
            $SurveyOfTheSchool->survey_id = request('survey_add');
            $SurveyOfTheSchool->school_id = $id;
            $SurveyOfTheSchool->save();
        }
        toastr()->success('Done');
        return Redirect::back();
    }

    //Add Admin
    public function AddAdminToClient(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $validator = Validator::make($request->all(), [
            'first_name_for_new_admin'  => 'required',
            'last_name_for_new_admin'   => 'required',
            'email_for_new_admin'       => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Client', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $newAdmin = new User;
            $newAdmin->first_name = request('first_name_for_new_admin');
            $newAdmin->last_name = request('last_name_for_new_admin');
            $newAdmin->email = request('email_for_new_admin');
            $newAdmin->password =  Hash::make(123456);
            $newAdmin->save();
            $AdminOfTheSchool =  new AdminOfTheSchool;
            $AdminOfTheSchool ->admin_id = $newAdmin->id;
            $AdminOfTheSchool ->school_id = $id;
            $AdminOfTheSchool ->save();
            $data=[];
            Mail::send(['html' => 'mail.AdminClientActive'], $data, function ($message) use($newAdmin) {
                $message->from('kristineshakaryan@gmail.com', 'alumni');
                $message->to($newAdmin->email)->subject('Recap');
            });
        }

        toastr()->success('Done');
        return Redirect::back();
    }

    // Add New School
    public function AddNewClient(Request $request){
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'logo'  => 'required|mimes:jpeg,bmp,png',
            'background_image'  => 'required|mimes:jpeg,bmp,png',
            'date_of_launch'    => 'required|date',
            'url'   => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'email_of_the_administrative_contact'          => 'required|email',
            'email_of_the_person_in_charge_of_alumni'      => 'required|email',
            'first_name_of_administrative_contact'         => 'required',
            'last_name_of_administrative_contact'          => 'required',
            'first_name_of_the_person_in_charge_of_alumni' => 'required',
            'last_name_of_the_person_in_charge_of_alumni'  => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $school = new School;
            $school->name = request('name');
            $school->date_of_creation = Carbon::now();
            $school->date_of_launch = request('date_of_launch');
            $school->url = request('url');
            $school->logo = parent::fileUpload(request('logo'),'images/Schools');
            $school->background_image = parent::fileUpload(request('background_image'),'images/Schools');
            $school->email_of_the_administrative_contact = request('email_of_the_administrative_contact');
            $school->first_name_of_administrative_contact = request('first_name_of_administrative_contact');
            $school->last_name_of_administrative_contact = request('last_name_of_administrative_contact');
            $school->first_name_of_the_person_in_charge_of_alumni = request('first_name_of_the_person_in_charge_of_alumni');
            $school->last_name_of_the_person_in_charge_of_alumni = request('last_name_of_the_person_in_charge_of_alumni');
            $school->email_of_the_person_in_charge_of_alumni = request('email_of_the_person_in_charge_of_alumni');
            if ($school->save()){
                if(request('name_of_group')){
                    $SchoolOfTheGroup = new SchoolOfTheGroup;
                    $SchoolOfTheGroup->school_id = $school->id;
                    $SchoolOfTheGroup->group_id = request('name_of_group');
                    $SchoolOfTheGroup->save();
                }
                if(request('survey')){
                    $SurveyOfTheSchool = new SurveyOfTheSchool();
                    $SurveyOfTheSchool->survey_id = request('survey');
                    $SurveyOfTheSchool->school_id = $school->id;
                    $SurveyOfTheSchool->save();
                }
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect(route('super_admin.AllClients'));
    }

    // Edit School
    public function EditClient(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($school = School::find($id)) {
            $degrees = DegreeOfTheSchool::where('school_id',$id)->get();
            $admins = AdminOfTheSchool::where('school_id',$id)->get();
            $users = SchoolOfTheUser::where('school_id',$id)->get();
            return response(['success' => true,'school' => $school,'degrees' => $degrees,'admins' => $admins,'users' => $users]);
        }else{
            return response(['success' => false]);
        }
    }

    // Update School
    public function UpdateClient(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $rules = [
            'logo'            => 'mimes:jpeg,bmp,png',
            'background_image' => 'mimes:jpeg,bmp,png',
            'name'            => 'required',
            'first_name_of_administrative_contact' => 'required',
            'last_name_of_administrative_contact' => 'required',
            'email_of_the_administrative_contact' => 'required|email',
            'first_name_of_the_person_in_charge_of_alumni' => 'required',
            'last_name_of_the_person_in_charge_of_alumni' => 'required',
            'email_of_the_person_in_charge_of_alumni' => 'required',
            'date_of_launch'  => 'required|date',
            'url'             => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'degree.*'        => 'required',
            'admins.*'        => 'required',
            'name_of_group'   => 'required',
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Schools', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $school = School::find($id);
            if( !$SchoolOfTheGroup = SchoolOfTheGroup::where('school_id',$id)->first()){
                $SchoolOfTheGroup = new SchoolOfTheGroup;
                $SchoolOfTheGroup->school_id = $id;
            }
            $SchoolOfTheGroup->group_id = request('name_of_group');
            $SchoolOfTheGroup->save();
            $school->name = request('name');
            if (request('logo')){
                $school->logo = parent::fileUpload(request('logo'),'images/Schools');
            }
            if (request('background_image')){
                $school->background_image = parent::fileUpload(request('background_image'),'images/Schools');
            }
            $school->url = request('url');
            $school->date_of_launch = request('date_of_launch');
            $school->first_name_of_administrative_contact = request('first_name_of_administrative_contact');
            $school->last_name_of_administrative_contact = request('last_name_of_administrative_contact');
            $school->email_of_the_administrative_contact = request('email_of_the_administrative_contact');
            $school->first_name_of_the_person_in_charge_of_alumni = request('first_name_of_the_person_in_charge_of_alumni');
            $school->last_name_of_the_person_in_charge_of_alumni = request('last_name_of_the_person_in_charge_of_alumni');
            $school->email_of_the_person_in_charge_of_alumni = request('email_of_the_person_in_charge_of_alumni');
            $school->save();
            toastr()->success('success');
            return Redirect(route('super_admin.AllClients'));
        }
    }

    // All Schools
    public function AllClients(){
        $schools = School::all();
        $degrees = Degree::all();
        $users   = User::where('type',User::user)->get();
        $admins = User::where('type',User::admin)->get();
        return view('super_admin.school.allschools',compact('schools','degrees','admins','users'));
    }

    // CLient Details
    public function ClientDetails($id = null){
        $school = School::find($id);
        $admins = User::where('type',User::admin)->get();
        $SchoolOfTheUsers = SchoolOfTheUser::where('school_id',$school->id)->orderBy('created_at' , 'desc')->limit(25)->get();
        $SurveyOfTheSchools = SurveyOfTheSchool::where('school_id',$school->id)->get();
        $dataofschooluser = SchoolOfTheUser::where('school_id',$school->id)->orderBy('created_at' , 'desc')->pluck('user_id')->toArray();
        $JobOfTheUserLasts = JobOfTheUser::whereIn('user_id', $dataofschooluser)->orderBy('created_at' , 'desc')->limit(10)->get();
        $JobOfTheUsers = JobOfTheUser::orderby('created_at','desc')->get();
        $AdminOfTheSchool = AdminOfTheSchool::where('school_id',$id)->get();
        $SchoolOfTheGroup = SchoolOfTheGroup::where('school_id',$id)->get();
        $DegreeOfTheSchools = DegreeOfTheSchool::where('school_id',$id)->get();
        return view('super_admin.school.schooldetails',compact('school','admins','SchoolOfTheUsers','SurveyOfTheSchools','JobOfTheUsers','JobOfTheUserLasts','AdminOfTheSchool','SchoolOfTheGroup','DegreeOfTheSchools'));
    }

    // Delete School
    public function DeleteClient(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $SchoolOfTheGroup = SchoolOfTheGroup::where('school_id',$id);
        $SchoolOfTheGroup->delete();
        $SchoolOfTheUser = SchoolOfTheUser::where('school_id',$id);
        $SchoolOfTheUser->delete();
        $AdminOfTheSchool = AdminOfTheSchool::where('school_id',$id);
        $AdminOfTheSchool->delete();
        $SurveyOfTheSchool = SurveyOfTheSchool::where('school_id',$id);
        $SurveyOfTheSchool->delete();
        if ($group = School::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
}
