<?php

namespace App\Http\Controllers\User;

use App\JobBoard;
use App\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\ResultOfTheSurvey;
use App\CategoryOfTheUser;
use App\SurveyTypes;
use App\BlogPost;
use App\User;
use Socialite;
use Exception;
use Session;
use Crypt;
use Hash;
use Mail;

class UserController extends Controller
{
    //Dashboard
    public function Dashboard(Request $request)
    {

        $jobs = JobBoard::orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            return view('user.user.jobmore', compact('jobs'));
        }
        $BlogPost = BlogPost::paginate(3);
        $users = User::where('type',User::user)->orderBy('id', 'DESC')->limit(6)->get();
        $mentors = User::where(['type' => User::user,'mentorat' => User::mentorat])->orderBy('id', 'DESC')->limit(4)->get();
        return view('user.user.dashboard',compact('BlogPost','users','mentors','jobs'));
    }

    // Login user
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|min:6',

        ]);
        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            $check = $this->checkLogin($request->input('email'),$request->input('password'));
            if ($check){
                return Redirect('/user/dashboard');
            }
            else{
                return Redirect::back();
            }

        }
    }


    //logout
    public function logout()
    {
        Session::forget('userData');
        return Redirect('/');
    }

    // check email or username and password
    public function checkLogin($username, $password)
    {
        $user = User::where(['type' => User::user,'email' => $username])->first();
        if(!empty($user)){
            if(Hash::check($password, $user->password) ){
                if ($user->status == 1) {
                    Session::put('userData', $user);
                    return true;
                }
                toastr()->error('status inactive!');
                return false;
            }
            toastr()->error('Password is wrong!');
            return false;
        }
        toastr()->error('Email is wrong!');
        return false;
    }

    public  function RedirectToLinkedin(){
        return Socialite::driver('linkedin')->stateless(Str::random(40))->scopes(['r_basicprofile','r_emailaddress','w_share'])->redirect();
    }


    public  function CallbackOnLinkedin(){

        $linkdinUser = Socialite::driver('linkedin')->stateless()->user();
        try {
        $existUser = User::where('email',$linkdinUser->email)->first();
        $name = null;
            if (!is_null($linkdinUser->avatar)){
                $name = str_random(20).'.jpg';
                $data = file_get_contents($linkdinUser->avatar);
                $new = "images/avatar/".$name;
                file_put_contents($new, $data);
            }
            if($existUser) {
                $existUser->first_name = $linkdinUser->first_name;
                $existUser->last_name = $linkdinUser->last_name;
                $existUser->avatar = $name;
                $existUser->linkedin = User::linkedin_login;
                $existUser->status = User::status_active;
                $existUser->save();
            }
            else {
                $user = new User;
                $user->first_name = $linkdinUser->first_name;
                $user->last_name = $linkdinUser->last_name;
                $user->avatar = $name;
                $user->email = $linkdinUser->email;
                $user->password =  Hash::make(str_random(20));
                $user->linkedin = User::linkedin_login;
                $user->status = User::status_active;
                $user->save();
            }

             Session::put('userData',  User::where('email',$linkdinUser->email)->first());
             return redirect(route('index'));
         }
         catch (Exception $e) {
             return 'error';
         }

    }

    // user register
    public function viewRegister(){
        $survey = SurveyTypes::find(SurveyTypes::login);
        return view('user.register',compact('survey'));
    }

     // user register post
     public function register(Request $request){
         $first_name = $request->input('first_name');
         $last_name	= $request->input('last_name');
         $email    	= $request->input('email');
         $birth     = $request->input('date');
         $password 	= $request->input('password');

         $small_description = $request->input('small_description');
         $category = $request->input('category');

         $validator	= Validator::make($request->all(), [
             'first_name'            => 'required',
             'last_name'             => 'required',
             'email'                 => 'required|email|unique:users',
             'password'              => 'required|min:6|confirmed',
             'password_confirmation' => 'required|min:6',
             'small_description'     => 'required',
             'category'              => 'required',
         ]);

         if ($validator->fails()) {
         	toastr()->error('Something is wrong!');
             return Redirect::back()
             ->withErrors($validator) // send back all errors to the login form
             ->withInput();
         } else {

         	$user = new User;
         	$user->first_name         = $first_name;
         	$user->last_name          = $last_name;
         	$user->email              = $email;
         	$user->password           = Hash::make($password);
         	$user->date_of_birth      = $birth;
         	$user->small_description  = $small_description;

         	if ($user->save()) {
                $CategoryOfTheUser = new CategoryOfTheUser();
                $CategoryOfTheUser->category_id = $category;
                $CategoryOfTheUser->user_id = $user->id;
                $CategoryOfTheUser->save();
     			toastr()->success('success');

                $this->survey($request,SurveyTypes::login,$user->id);
             }
           	return Redirect('/');
         }
     }

     // survey create
    public  function survey(Request $request,$type,$user_id){
        $survey = SurveyTypes::find($type);
        foreach($survey->getSurvey->GetQuestions as $question){
            if (!is_null($result = $request->input('answer'.$question->id))){
                $answer = new ResultOfTheSurvey();
                $answer->survey_type_id = $type;
                $answer->survey_id = $question->survey_id;
                $answer->questions_id = $question->id;
                $answer->user_id = $user_id;
                if (is_array($result)){
                    $items = [];
                    foreach($result as $item){
                        $items[] = Crypt::decrypt($item);
                    }
                    $answer->answer = json_encode($items);
                }else{
                    $answer->answer = $result;
                }
                $answer->save();
            }
        }
    }

    // user profile
    public  function  UserProfile($id){
        if($user = User::where(['type' => User::user,'id' => $id])->first()){
            return view('user.directory.profile',compact('user'));
        }
        toastr()->error('Such user does not exist!');
        return Redirect(route('user.directory'));
    }




    // profile
    public  function profile(){
        $user = User::find( Session::get('userData')->id);
        return view('user.user.profile',compact('user'));
    }

    // edit profile
    public function  EditProfile(Request $request){
        $id =  Session::get('userData')->id;
        $user = User::find($id);

        if (request()->isMethod('post'))
        {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name'  => 'required',
                'picture'  => 'mimes:jpeg,bmp,png',
                'city'       => 'required',
            ]);

            if ($validator->fails())
            {
                toastr()->error('Something is wrong!');
                return Redirect::back()
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput();
            }else{

                $user->first_name = request('first_name');
                $user->last_name  = request('last_name');
                if (request('picture')){
                    $user->avatar = parent::fileUpload(request('picture'),'images/Avatar');
                }
                $user->city       = request('city');
                $user->save();

            }

            return redirect(route('admin.profile'));
        }
        return view('user.user.edit-profile',compact('user'));
    }


}
