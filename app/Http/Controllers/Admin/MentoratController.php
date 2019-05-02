<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;
use Hash;

class MentoratController extends Controller
{
    //
    // mentorship
    public  function mentorship(Request $request){

        $users = User::where(['mentorat' => User::mentorat,'type' => User::user])->orderBy('id', 'DESC')->paginate(2);
        if ($request->ajax()) {
            $ids = Session::get('users_ids');
            Session::put('users_ids', array_merge($ids, $users->pluck('id')->toArray()));
            return view('admin.mentorat.usermore', compact('users'));
        }
        Session::forget('users_ids');
        Session::put('users_ids', $users->pluck('id')->toArray());
        return view('admin.mentorat.mentorship',compact('users'));
    }

    // csv mentor
    public  function MentorCSV(){
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=AllUser.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $users =  User::whereIn('id', Session::get('users_ids'))->get();
        $columns = array('id','First Name','Last Name','Email','Date Of Birth','Category','Graduation Year','Small Description','Created At');

        $callback = function() use ($users, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($users as $user) {
                $categorys = ($user->chooseColor)?$user->chooseColor->category->title:'
                ';
                fputcsv($file, array($user->id, $user->first_name, $user->last_name, $user->email,date('Y-m-d',strtotime($user->date_of_birth)),$categorys,$user->graduation_year,$user->small_description,$user->created_at));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
