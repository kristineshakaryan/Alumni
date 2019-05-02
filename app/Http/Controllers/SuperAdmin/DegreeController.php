<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DegreeOfTheSchool;
use App\DegreeOfTheUser;
use Carbon\Carbon;
use App\Degree;
use Crypt;

class DegreeController extends Controller
{
    //
    public function NewDegree(){
        return view('super_admin.degree.newdegree');
    }
    // Add Degree from school
    public function AddDegree(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $validator = Validator::make($request->all(), [
            'name_of_degree'         => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Degree', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $degree = new Degree;
            $degree->name = request('name_of_degree');
            $degree->date_of_launch = Carbon::now();
            if ($degree->save()){
                $DegreeOfTheSchool = new DegreeOfTheSchool();
                $DegreeOfTheSchool->degree_id = $degree->id;
                $DegreeOfTheSchool->school_id = $id;
                $DegreeOfTheSchool->save();
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect::back();
    }

    // Get Degree Of The School
    public function GetDegreeOfTheSchools(Request $reqeust){
        if( request('schools')){
            $DegreesArray = [];
            foreach(request('schools') as $school_id){
                $DegreesOfTheSchool = DegreeOfTheSchool::where('school_id',$school_id)->get();
                if($DegreesOfTheSchool->count() > 0){
                    foreach($DegreesOfTheSchool as $DegreeOfTheSchool ){
                        $DegreesArray[] = $DegreeOfTheSchool->degree;
                    }
                }
            }
            return response(['success' => true,'DegreesArray' => $DegreesArray]);
        }
    }
    // Degree Details
    public function DegreeDetails($id = null){
        $degree = Degree::find($id);
        return view('super_admin.degree.degreedetails',compact('degree'));
    }
    // Add New Degree jnj ent
    public function AddNewDegree(Request $request){

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $degree = new Degree;
            $degree->name = request('name');
            if ($degree->save()){
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect(route('super_admin.AllDegrees'));
    }

    // Edit Degree
    public function EditDegree(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($degree = Degree::find($id)) {
            return response(['success' => true,'degree' => $degree]);
        }else{
            return response(['success' => false]);
        }
    }

    // Update Degree
    public function UpdateDegree(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $rules = [
            'name'   => 'required',
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Degree', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {

            $degree = Degree::find($id);
            $degree->name = request('name');
            $degree->save();
            toastr()->success('success');
            return Redirect(route('super_admin.AllClients'));
        }
    }

    // All Degrees
    public function AllDegrees(){
        $degrees = Degree::all();
        return view('super_admin.degree.alldegree',compact('degrees'));
    }

    // Delete Degree
    public function DeleteDegree(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $DegreeOfTheUser = DegreeOfTheUser::where('degree_id',$id);
        $DegreeOfTheSchool = DegreeOfTheSchool::where('degree_id',$id);
        if($DegreeOfTheSchool){
            $DegreeOfTheSchool->delete();
        }
        if($DegreeOfTheUser){
            $DegreeOfTheUser->delete();
        }
        if (Degree::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
}
