<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Crypt;
use Mail;

class EmailController extends Controller
{
    // All Degrees
    public function EmailingAllUsers(){
        $users = User::where('type',User::user)->get();
        return view('super_admin.emailing.emailingallusers',compact('users'));
    }
}
