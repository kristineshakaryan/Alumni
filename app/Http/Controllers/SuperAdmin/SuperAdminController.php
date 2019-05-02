<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Session;
use Mail;


class SuperAdminController extends Controller
{

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
                return Redirect('/super_admin/dashboard');
            }
            else{
                return Redirect::back();
            }

        }
    }

    // check email or username and password
    public function checkLogin($username, $password)
    {
        $user = User::where(['type' => User::super_admin,'email' => $username])->first();
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

    //logout
    public function logout()
    {
        Session::forget('userData');
        return Redirect(route('login.super_admin.get'));
    }

    // setting
    public function setting()
    {
        return view('super_admin.setting');
    }

}
