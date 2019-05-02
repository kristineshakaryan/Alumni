<?php

namespace App\Http\Controllers\Admin;

use App\JobBoard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;
use Hash;

class AdminController extends Controller
{
    //
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
                return Redirect(route('admin.dashboard'));
            }
            else{
                return Redirect::back();
            }

        }
    }

    // user profile
    public  function  UserProfile($id){
        if($user = User::where(['type' => User::user,'id' => $id])->first()){
            return view('admin.directory.profile',compact('user'));
        }
        toastr()->error('Such user does not exist!');
        return Redirect(route('admin.directory'));
    }

    //logout
    public function logout()
    {
        Session::forget('userData');
        return Redirect(route('login.admin.get'));
    }

    // check email or username and password
    public function checkLogin($username, $password)
    {
        $user = User::where(['type' => User::admin,'email' => $username])->first();
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

    // dashboard
    public function dashboard(Request $request)
    {
        $id =  Session::get('userData')->id;
        $user = User::find($id);
        $jobs = JobBoard::orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            return view('admin.admin.jobmore', compact('jobs'));
        }

        $users = User::where('type',User::user)->orderBy('id', 'DESC')->limit(6)->get();
        $mentors = User::where(['type' => User::user,'mentorat' => User::mentorat])->orderBy('id', 'DESC')->limit(4)->get();
        return view('admin.admin.dashboard',compact('user','users','mentors','jobs'));
    }

    // profile
    public function profile(){
        $id =  Session::get('userData')->id;
        $user = User::find($id);
        return view('admin.admin.profile',compact('user'));
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
                'picture'    => 'mimes:jpeg,bmp,png',
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
        return view('admin.admin.edit-profile',compact('user'));
    }

}
