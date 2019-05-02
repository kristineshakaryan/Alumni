<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Answer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResultOfTheSurvey;
use App\CategoryOfTheUser;
use App\DegreeOfTheUser;
use App\SchoolOfTheUser;
use Carbon\Carbon;
use App\Category;
use App\Degree;
use App\School;
use App\User;
use Crypt;

class UsersController extends Controller
{

    // Add New user
    public function AddNewUserCsv(Request $request){
        $validator = Validator::make($request->all(), [
            'csv' => 'required|mimes:csv,txt'
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {

            $csv = request('csv')->getPathName();
            $file = fopen($csv, "r");
            $data = [];
            $i = 1;
            while (($row = fgetcsv($file, 200, ",")) !== FALSE) {
                $user = User::where('email', $row[2])->first();
                if ($i != 1){
                    if(empty($user)){
                        if (filter_var($row[2], FILTER_VALIDATE_EMAIL) && !empty($row[0]) && !empty($row[1])) {
                            $Degree = Degree::where('name',$row[4])->first();
                            $category_id = Category::where('title',$row[5])->first();
                            $user = new User;
                            $user->first_name = $row[0];
                            $user->last_name = $row[1];
                            $user->email = $row[2];
                            $user->graduation_year = $row[3];
                            $user->password = Hash::make(123456);
                            $user_save = false;
                            if(!$user->save()){
                                $user_save = true;
                            }
                            if(empty($Degree)){
                                $Degree = new Degree;
                                $Degree->name = $row[4];
                                $Degree->save();
                            }
                            //Add new category to user from csv
                            $CategoryOfTheUser = new CategoryOfTheUser();
                            $CategoryOfTheUser->category_id = $category_id->id;
                            $CategoryOfTheUser->user_id = $user->id;
                            $CategoryOfTheUser->save();
                            //Add new Degree to user from csv
                            $DegreeOfTheUser = new DegreeOfTheUser;
                            $DegreeOfTheUser->degree_id = $Degree-> id;
                            $DegreeOfTheUser->user_id   = $user  -> id;
                            $DegreeOfTheUser->save();
                            if ($user_save){
                                toastr()->error("There is a problem on this line $i");
                                return Redirect::back();
                            }
                        } else {
                            toastr()->error("There is a problem on this line $i");
                            return Redirect::back();
                        }
                    }else{
                        toastr()->warning("$row[2] such user already exists");
                    }
                }
                $i++;
            }
        }
        toastr()->success('success');
        return Redirect::back();
    }
    public function NewUser(){
        return view('super_admin.users.newuser');
    }
    // User Details
    public function UserDetails($id = null){
        $user = User::find($id);
        $categories = Category::all();
        $CategoryOfTheUser = CategoryOfTheUser::where('user_id',$id)->get();
        $DegreeOfTheUser = DegreeOfTheUser::where('user_id',$id)->get();
        return view('super_admin.users.userdetails',compact('user','categories','CategoryOfTheUser','DegreeOfTheUser'));
    }
    public function AddNewUser(Request $request){
        $first_name = request('first_name');
        $last_name  = request('last_name');
        $email      = request('email');
        $category   = request('category');
        $city       = request('city');
        $degree     = request('degree');
        $rules = [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required|email|unique:users',
            'category'    => 'required',
            'graduation_year' =>  'required',
            'school.*'    => 'required|numeric',
        ];
        $validator	= Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $user = new User;
            $user->first_name  = $first_name;
            $user->last_name   = $last_name;
            $user->email       = $email;
            $user->city        = $city;
            $user->avatar      = 'default.jpg';
            $user->date_of_import = Carbon::now();
            $user->graduation_year_id = request('graduation_year');
            $user->password    = Hash::make(123456);
            if ($user->save()){
                $CategoryOfTheUser = new CategoryOfTheUser;
                $CategoryOfTheUser->category_id = $category;
                $CategoryOfTheUser->user_id = $user->id;
                $CategoryOfTheUser->save();

                foreach (request('schools') as $school_id){
                    $school =  new SchoolOfTheUser;
                    $school->school_id = $school_id;
                    $school->user_id = $user->id;
                    $school->save();
                }

                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect(route('super_admin.AllUsers'));
    }
    // Delete User
    public function DeleteUser(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $CategoryOfTheUser = CategoryOfTheUser::where('user_id',$id);
        $CategoryOfTheUser -> delete();
        $DegreeOfTheUser = DegreeOfTheUser::where('user_id',$id);
        $DegreeOfTheUser -> delete();
        if ($group = User::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
    // Download Survey Answers for User
    public function DownloadSurveyAnswersUser($id){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Survey.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $results =  ResultOfTheSurvey::where('user_id', $id)->get();

        $columns = array('Survay Title','Question','Answer');

        $callback = function() use ($results, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($results as $key => $result) {
                if ($key>0){
                    $title = ($results[$key-1]->survey_id == $results[$key]->survey_id)?' ':$result->GetSurvey->name;
                }else{
                    $title = $result->GetSurvey->name;
                }
                $question = ($result->GetQuestion->title)?$result->GetQuestion->title:null;
                $answer = $result->answer;
                $answers = json_decode($result->answer);
                if (is_array($answers)){
                    $answer = '';
                    foreach ($answers as $answer_id){
                        $answer .= Answer::find($answer_id)->title.', ';
                    }
                }

                fputcsv($file, array($title,  $question,trim($answer,", ")));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    // Update Group
    public function UpdateUser(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $first_name = request('first_name');
        $last_name = request('last_name');
        $category_id = request('category');
        $email = request('email');
        $city = request('city');
        $graduation_year = request('graduation_year');
        $mentorat= request('mentorat');
        if( $mentorat == 'on' ){
            $mentorat = 1;
        }
        else{
            $mentorat = 0;
        }
        $rules = [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'email'           => 'required|email',
            'graduation_year' => 'required|numeric',
            'category'        => 'required|numeric',
            'schools.*'       => 'required|numeric',
        ];
        $validator	= Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $User = User::find($id);
            $User->first_name = $first_name;
            $User->last_name = $last_name;
            $User->email = $email;
            $User->city = $city;
            $User->graduation_year_id = $graduation_year;
            $User->mentorat = $mentorat;
            if (request('avatar')){
                $User->avatar = parent::fileUpload(request('avatar'),'images/Users');
            }
            if($User->save()){
                CategoryOfTheUser::where('user_id',$id)->delete();
                $category =  new CategoryOfTheUser;
                $category->category_id = $category_id;
                $category->user_id = $id;
                $category->save();

                SchoolOfTheUser::where('user_id',$id)->delete();
                foreach (request('schools') as $school_id){
                    $school =  new SchoolOfTheUser;
                    $school->school_id = $school_id;
                    $school->user_id = $id;
                    $school->save();
                }

                DegreeOfTheUser::where('user_id',$id)->delete();
                if(request('degree')){
                    $degree =  new DegreeOfTheUser;
                    $degree->degree_id = request('degree');
                    $degree->user_id = $id;
                    $degree->save();
                }

            }
            toastr()->success('success');
            return Redirect::back();
        }
    }
    // Edit User
    public function EditUser(Request $request)
    {
        $id = Crypt::decrypt($request->input('id'));
        if ($users = User::find($id)) {
            $schools = SchoolOfTheUser::where('user_id',$id)->get();
            $degrees = DegreeOfTheUser::where('user_id',$id)->get();
            $categorys = CategoryOfTheUser::where('user_id',$id)->get();
            return response(['success' => true,'users' => $users,'degrees' => $degrees,'schools' => $schools,'categorys' => $categorys]);
        } else {
            return response(['success' => false]);

        }
    }
    // All Users
    public function AllUsers(){
        $users = User::all();
        $categories = Category::all();
        $schools = School::all();
        $degrees = Degree::all();
        return view('super_admin.users.allusers',compact(['users','categories','schools','degrees']));
    }
}
