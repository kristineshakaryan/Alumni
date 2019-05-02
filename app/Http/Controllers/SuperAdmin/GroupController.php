<?php

namespace App\Http\Controllers\SuperAdmin;
use App\SchoolOfTheUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\SchoolOfTheGroup;
use App\AdminOfTheGroup;
use Carbon\Carbon;
use App\Groups;
use App\School;
use App\User;
use Crypt;
use Mail;

class GroupController extends Controller
{
    //
    public function NewGroup(){
        return view('super_admin.group.newgroup');
    }
    //Add Admin
    public function AddAdminToGroup(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $validator = Validator::make($request->all(), [
            'first_name_for_new_admin'  => 'required',
            'last_name_for_new_admin'   => 'required',
            'email_for_new_admin'       => 'required|email|unique:users,email',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Group', 'error');
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
            $AdminOfTheGroup =  new AdminOfTheGroup;
            $AdminOfTheGroup ->admin_id = $newAdmin->id;
            $AdminOfTheGroup ->group_id = $id;
            $AdminOfTheGroup ->save();
            $data=[];
            Mail::send(['html' => 'mail.AdminGroupActive'], $data, function ($message) use($newAdmin) {
                $message->from('kristineshakaryan@gmail.com', 'alumni');
                $message->to($newAdmin->email)->subject('Recap');
            });
        }

        toastr()->success('Done');
        return Redirect::back();
    }
    // Add New Group
    public function AddNewGroup(Request $request){
        $name_of_group = request('name_of_group');
        $date_of_launch = request('date_of_launch');
        $contact_first_name = request('contact_first_name');
        $contact_last_name = request('contact_last_name');
        $contact_email = request('contact_email');
        $rules = [
            'name_of_group'       => 'required',
            'date_of_launch'      => 'required|date',
            'contact_first_name'  => 'required',
            'contact_last_name'   => 'required',
            'contact_email'       => 'required|email',
        ];

        $validator	= Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $groups = new Groups;
            $groups->name = $name_of_group;
            $groups->date_of_creation = Carbon::now();
            $groups->date_of_launch = $date_of_launch;
            $groups->contact_first_name = $contact_first_name;
            $groups->contact_last_name = $contact_last_name;
            $groups->contact_email = $contact_email;
            $groups->logo = parent::fileUpload(request('logo_for_group'),'images/Groups');
            if ($groups->save()){
                if(request('schools')){
                    foreach (request('schools') as $school_id){
                        $school =  new SchoolOfTheGroup;
                        $school->school_id = $school_id;
                        $school->group_id = $groups->id;
                        $school->save();
                    }
                }
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
            return Redirect(route('super_admin.AllGroups'));
        }
        return view('super_admin.group.newgroup');
    }
    // Edit Group
    public function EditGroup(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $SchoolOfTheGroup = SchoolOfTheGroup::where('group_id',$id)->get();
        $groupchoosedschools = [];
        if($SchoolOfTheGroup){
            foreach($SchoolOfTheGroup as $sotg){
                $groupchoosedschools[] = $sotg->GetSchoolInfo;
            }
        }
        $schools = School::all();
        $showschools = [];
        foreach($schools as $school){
            if(!$school->checkifBusy){
                $showschools[] = $school;
            }
        }
        if ($groups = Groups::find($id)) {
            return response(['success' => true,'groups' => $groups,'showschools' => $showschools,'groupchoosedschools' => $groupchoosedschools]);
        }else{
            return response(['success' => false]);
        }
    }

    // Group Details
    public function GroupDetails($id = null){
        $group = Groups::find($id);

        $SchoolOfTheGroup = SchoolOfTheGroup::where('group_id',$id)->get();
        $schools = Array();
        foreach( $SchoolOfTheGroup as $key => $school ){
            $schools[] = $school -> ChooseSchoolInfo;
        }
        $AdminOfTheGroup = AdminOfTheGroup::where('group_id',$id)->get();
        $SchoolOfTheGroups = SchoolOfTheGroup::where('group_id',$id)->get();
        $NumberOfUsers = 0;
        foreach($SchoolOfTheGroups as $SchoolOfTheGroup ){
            $NumberOfUsers += $SchoolOfTheGroup->SchoolOfTheUser->count();
        }
        return view('super_admin.group.groupdetails',compact('group','AdminOfTheGroup','schools','SchoolOfTheUser','NumberOfUsers'));
    }

    // Update Group
    public function UpdateGroup(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $name = request('name');
        $contact_first_name = request('contact_first_name');
        $contact_last_name = request('contact_last_name');
        $contact_email = request('contact_email');
        $date_of_launch = request('date_of_launch');
        $logo_for_group	= $request->file('logo_for_group');
        $rules = [
            'name'                       => 'required',
            'contact_first_name'         => 'required',
            'contact_last_name'          => 'required',
            'contact_email'              => 'required|email',
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Groups', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $logo = parent::fileUpload($logo_for_group , 'images/Groups');
            $Groups = Groups::find($id);
            $Groups->name = $name;
            $Groups->contact_first_name = $contact_first_name;
            $Groups->contact_last_name = $contact_last_name;
            $Groups->contact_email = $contact_email;
            $Groups->date_of_launch = $date_of_launch;
            if( !empty($logo) ){
                $Groups->logo = $logo;
            }
            if($Groups->save()){
                $schools = SchoolOfTheGroup::where('group_id',$id)->delete();
                if(request('schools')){
                    foreach (request('schools') as $school_id){
                        $school =  new SchoolOfTheGroup;
                        $school->school_id = $school_id;
                        $school->group_id = $id;
                        $school->save();
                    }
                }
            }
            toastr()->success('success');
            return Redirect(route('super_admin.AllGroups'));
        }
    }
    // All Groups
    public function AllGroups(){
        $groups = Groups::all();
        $schools = School::all();
        return view('super_admin.group.allgroup',compact('groups','schools'));
    }
    // Delete Group
    public function DeleteGroup(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $SchoolOfTheGroup = SchoolOfTheGroup::where('group_id',$id);
        $SchoolOfTheGroup->delete();
        if ($group = Groups::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
}
