<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\ResetPassword;
use App\User;
use Hash;
use Session;
use Mail;

class UserController extends Controller
{
    
    public function index(){
    	$user = Session::get('userData');
    	switch ($user->type) {
    		case User::admin:
    			return Redirect('/admin/dashboard');
    		case User::super_admin:
    			return Redirect('/super_admin/dashboard');
    		case User::user:
    			return Redirect('/user/dashboard');
			default:
    			return Redirect('/login');
    	}
    }


//
//    // Login user
//    public function login(Request $request) {
//        $validator = Validator::make($request->all(), [
//            'email' => 'required|max:255',
//            'password' => 'required|min:6',
//
//        ]);
//        if ($validator->fails())
//        {
//            toastr()->error('Something is wrong!');
//            return Redirect::back()
//            ->withErrors($validator) // send back all errors to the login form
//            ->withInput();
//        }else{
//            $check = $this->checkLogin($request->input('email'),$request->input('password'));
//            switch ($check) {
//                case 'admin':
//                    return Redirect('/admin/dashboard');
//                case 'super_admin':
//                    return Redirect('/super_admin/dashboard');
//                case 'user':
//                    return Redirect('/user/dashboard');
//                default:
//                    return Redirect::back();
//            }
//        }
//    }

    // Check Token for Reset Password
    public function CheckToken($token) {
        $resetpassword = ResetPassword::where('token',$token)->first();
        if($resetpassword){
            $current_time = strtotime("now");
            $expire_time = strtotime($resetpassword->expire);
            if( $resetpassword->status == 0 && $current_time - $expire_time < 3600){
                if ($user = User::find($resetpassword->user_id)) {
                    $password = str_random(8);

                $data = [
                    'password' => $password,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ];

                Mail::send(['html' => 'mail.show_password'], $data, function ($message) use ($user){
                    $message->from('kristineshakaryan@gmail.com', 'Datalumni');
                    $message->to($user->email,$user->first_name)->subject('Show Password');
                });

                $user->password   = Hash::make($password);
                $user->save();

                $resetpassword->status = 1;
                $resetpassword->save();
                toastr()->success("Your new password has been sent to your email");
                }else{
                    toastr()->error('Something is wrong!'); 
                }
                return Redirect('/login');
            }else if($resetpassword->status == 1){
                toastr()->error("This link has been used");
            }else{
                toastr()->error("The link has been expired");
            }
        }else{
            toastr()->error("Such link does not exist");
        }
        return Redirect('/ResetPassword');
    }
    //ResetPassword
    public function ResetPassword(Request $request)
    {
        $email = $request->input('email');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',

        ]);
        if ($validator->fails()) 
        {
            toastr()->error('Something is wrong!'); 
            return Redirect::back()
            ->withErrors($validator) // send back all errors to the login form
            ->withInput();
        }else{
            $user = User::where('email',$email)->first();
            if($user){
                $token = str_random(32);
                $reset_password = new ResetPassword();
                $reset_password->user_id = $user->id;
                $reset_password->token   = $token;
                $reset_password->status  = 0;
                $reset_password->expire  = date('Y-m-d H:i:s');
                $reset_password->save();
                toastr()->success("Please check your Email");
                $data = [
                    'token' => $token,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ];
                Mail::send(['html' => 'mail.confirm_email'], $data, function ($message) use ($user){
                    $message->from('kristineshakaryan@gmail.com', 'Datalumni');
                    $message->to($user->email,$user->first_name)->subject('confirm');
                });
            }
            else{
                toastr()->error("The email doesn't exist"); 
            }
        }
        return Redirect::back();
    }


//    // check email or username and password
//    public function checkLogin($username, $password)
//    {
//          $user = User::where('email',$username)->first();
//          if(!empty($user)){
//            if(Hash::check($password, $user->password) ){
//            	if ($user->status == 1) {
//                	//
//                	switch ($user->type) {
//                		case User::admin:
//                            Session::put('userData', $user);
//                			return 'admin';
//                		case User::super_admin:
//                            Session::put('userData', $user);
//                            return 'super_admin';
//                		case User::user:
//                            Session::put('userData', $user);
//                            return 'user';
//                	}
//            	}
//                toastr()->error('status inactive!');
//                return false;
//            }
//            toastr()->error('Password is wrong!');
//            return false;
//        }
//        toastr()->error('Email is wrong!');
//        return false;
//    }

    // chnage password
    public function changePassword(Request $request){
        $old_password   = $request->input('old_password');
        $password       = $request->input('password');

        $validator = Validator::make($request->all(), [
            'old_password'          => 'required|min:6',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ]);
        if ($validator->fails()) 
        {
            toastr()->error('Something is wrong!'); 
            return Redirect::back()
            ->withErrors($validator) // send back all errors to the login form
            ->withInput();
        }else{
            $id =  Session::get('userData')->id;
            $user = User::find($id);
            if(Hash::check($old_password, $user->password))
            {
                $user->password = Hash::make($password);
                if ($user->save()) {
                    toastr()->success('success');
                }
            }else{
                toastr()->error('Password is wrong!'); 
            }

            return Redirect::back();
        }
    }
}
