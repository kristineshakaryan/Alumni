<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JobOfTheCompany;
use App\JobBoard;
use App\School;
use Crypt;

class JobBoardController extends Controller
{
    public function NewJobBoard()
    {
        return view('super_admin.jobboard.newjobboard');
    }

    // Add New Job Board
    public function AddNewJobBoard(Request $request){

        $validator = Validator::make($request->all(), [
            'title'  => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $job = new JobBoard;
            $job ->title = request('title');
            if ($job->save()){
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect(route('super_admin.AllJobBoards'));
    }

    // Edit Job Board
    public function EditJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($job = JobBoard::find($id)) {
            return response(['success' => true,'job' => $job]);
        }else{
            return response(['success' => false]);
        }
    }

    // Update Job Board
    public function UpdateJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $rules = [
            'title'   => 'required',
            'school'  => 'required',
            'link'    => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('jobs', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {

            $job = JobBoard::find($id);
            $job->title = request('title');
            $job->school_id = request('school');
            $job->status = (request('status') == 'on')?1:0;
            $job->link = request('link');
            $job->save();
            toastr()->success('success');
            return Redirect::back();
        }
    }

    // All Job Board
    public function AllJobBoards(){
        $jobs = JobBoard::all();
        $schools = School::all();
        return view('super_admin.jobboard.alljobboard',compact('jobs','schools'));
    }

    // Delete Job Board
    public function DeleteJobBoard(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $JobOfTheCompany = JobOfTheCompany::where('job_id',$id);
        $JobOfTheCompany->delete();
        if (JobBoard::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
}
