<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;

class MentoratController extends Controller
{
    //
    // mentorship
    public  function mentorship(Request $request){

        $users = User::where('mentorat',User::mentorat)->orderBy('id', 'DESC')->paginate(2);
        if ($request->ajax()) {
            return view('user.mentorat.usermore', compact('users'));
        }
        return view('user.mentorat.mentorship',compact('users'));
    }
}
