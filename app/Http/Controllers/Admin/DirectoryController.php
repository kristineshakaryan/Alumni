<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\CategoryOfTheUser;
use App\User;
use Session;
use Hash;

class DirectoryController extends Controller
{
    //
    // directory
    public  function directory(Request $request){

        $free_search = $request->input('free_search');
        $degrees = $request->input('degree');
        $year_of_graduation = $request->input('year_of_graduation');
        $categorys = $request->input('category');
        $jobs = $request->input('job');
        $users = User::where('type',User::user)
            ->where(function ($sql) use ($free_search,$degrees,$year_of_graduation,$categorys,$jobs){
                $sql->Where(function($query) use ($free_search){
                    if(!empty($free_search)){
                        $query->orWhere('first_name', 'like', '%' . $free_search . '%')
                            ->orWhere('last_name', 'like', '%' . $free_search . '%');
                    }
                })->Where(function ($query) use ($degrees){
                    if(!empty($degrees)) {
                        $query->WhereHas('chooseDegree', function ($q) use ($degrees) {
                            $q->whereHas('degree', function ($query1) use ($degrees) {
                                $query1->Where('name',$degrees);
                            });
                        });
                    }
                })->Where(function ($query) use ($categorys){
                    if(!empty($categorys)) {
                        $query->WhereHas('chooseColor', function ($q) use ($categorys) {
                            $q->whereHas('category', function ($query1) use ($categorys) {
                                $query1->Where('title',$categorys);
                            });
                        });
                    }
                })->Where(function ($query) use ($jobs){
                    if(!empty($jobs)){
                        $query->WhereHas('chooseJob', function ($q) use($jobs) {
                            $q->whereHas('job', function ($query1) use ($jobs) {
                                $query1->Where('title', $jobs);
                            });
                        });
                    }
                })->Where(function ($query) use ($year_of_graduation){
                    if(!empty($year_of_graduation)){
                        $query->Where('graduation_year', 'like', '%' . $year_of_graduation . '%');
                    }
                });
            })->orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            $ids = Session::get('users_ids');
            Session::put('users_ids', array_merge($ids, $users->pluck('id')->toArray()));
            return view('admin.directory.usermore', compact('users'));
        }
        Session::forget('users_ids');
        Session::put('users_ids', $users->pluck('id')->toArray());
        return view('admin.directory.directory',compact('users', 'free_search','degrees','year_of_graduation','categorys','jobs'));
    }

    // download csv
    public  function UserCSV(){

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

    // New User
    public function NewUser(){
        return view('admin.directory.new-user');
    }

    // create new user
    public function  AddNewUser(Request $request){
        $first_name = request('first_name');
        $last_name  = request('last_name');
        $email      = request('email');
        $categorys  = request('category');
        $city       = request('city');
        $rules = [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required|email|unique:users',
            'category'    => 'required',
            'city'        => 'required',
            'picture'     => 'mimes:jpeg,bmp,png',
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

            if (request('picture')){
                $user->avatar = parent::fileUpload(request('picture'),'images/Avatar');
            }
            $user->password    = Hash::make(123456);
            if ($user->save()){
                $CategoryOfTheUser = new CategoryOfTheUser;
                $CategoryOfTheUser->category_id = $categorys;
                $CategoryOfTheUser->user_id = $user->id;
                $CategoryOfTheUser->save();
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
            return Redirect(route('admin.directory'));
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

    // edir user
    public  function  UserEditProfile($id){

        if ($user = User::where(['type' => User::user,'id' => $id])->first()){
            return view('admin.directory.edit-profile',compact('user'));
        }

        return redirect(route('admin.directory'));
    }

    // update user
    public  function UserUpdateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name'  => 'required',
            'city'       => 'required',
            'city'       => 'required',
            'picture'    => 'mimes:jpeg,bmp,png',
        ]);

        if ($validator->fails())
        {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        }else{
            if ($user = User::where(['type' => User::user,'id' =>  Crypt::decrypt(request('id'))])->first()){
                $user->first_name = request('first_name');
                $user->last_name  = request('last_name');
                if (request('picture')){
                    $user->avatar = parent::fileUpload(request('picture'),'images/Avatar');
                }
                $user->city       = request('city');
                $user->status     = is_null(request('active'))?User::status_inactive:User::status_active;
                $user->save();
            }
        }
        return redirect(route('admin.directory'));
    }

}
