<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SchoolsOfTheCompany;
use App\JobOfTheCompany;
use Carbon\Carbon;
use App\Company;
use Crypt;

class CompanyController extends Controller
{
    // Add Company
    public function NewCompany(){
        return view('super_admin.company.newcompany');
    }
    // All Companies
    public function AllCompanies (){
        $companies = Company::all();
        return view('super_admin.company.allcompany',compact('companies'));
    }
    // Delete Company
    public function DeleteCompany(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $JobOfTheCompany = JobOfTheCompany::where('company_id',$id);
        $JobOfTheCompany->delete();
        if ($Company = Company::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }

    // Company Details
    public function CompanyDetails($id = null){
        $company = Company::find($id);
        return view('super_admin.company.companydetails',compact('company'));
    }
    // Edit Company
    public function EditCompany(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        if ($company = Company::find($id)) {
            return response(['success' => true,'company' => $company]);
        }else{
            return response(['success' => false]);
        }
    }
    // Update Company
    public function UpdateCompany(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $rules = [
            'name'          => 'required',
            'logo'          => 'mimes:jpeg,bmp,png',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'function_of_the_person'     => 'required',
            'email_of_the_person'        => 'required',
        ];
        $validator	= Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            $validator->errors()->add('Company', 'error');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $Company = Company::find($id);
            $Company->name = request('name');
            if (request('logo')){
                $Company->logo = parent::fileUpload(request('logo'),'images/Companies');
            }
            $Company->last_activity = request('last_activity');
            $Company->first_name = request('first_name');
            $Company->last_name = request('last_name');
            $Company->function_of_the_person = request('function_of_the_person');
            $Company->email_of_the_person = request('email_of_the_person');
            $Company->description = request('description');
            $Company->last_activity = Carbon::now();

            if($Company->save()){
                if(request('schools')){
                    foreach (request('schools') as $school_id){
                        $school =  new SchoolsOfTheCompany;
                        $school->school_id = $school_id;
                        $school->company_id = $Company->id;
                        $school->save();
                    }
                }

            }
            toastr()->success('success');
            return Redirect::back();
        }
    }
    // Add New Company
    public function AddNewcompany (Request $request){

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'logo'       => 'required|mimes:jpeg,bmp,png',
            'first_name' => 'required',
            'email_of_the_person'    => 'required|email',
            'function_of_the_person' => 'required',
            'last_name'  => 'required',
        ]);
        if ($validator->fails()) {
            toastr()->error('Something is wrong!');
            return Redirect::back()
                ->withErrors($validator) // send back all errors to the login form
                ->withInput();
        } else {
            $Company = new Company;
            $Company->name = request('name');
            $Company->logo = parent::fileUpload(request('logo'),'images/Companies');
            $Company->first_name = request('first_name');
            $Company->description = request('description');
            $Company->last_name = request('last_name');
            $Company->email_of_the_person = request('email_of_the_person');
            $Company->function_of_the_person = request('function_of_the_person');
            if ($Company->save()){
                if(request('schools')){
                    foreach (request('schools') as $school_id){
                        $school =  new SchoolsOfTheCompany;
                        $school->school_id = $school_id;
                        $school->company_id = $Company->id;
                        $school->save();
                    }
                }
                toastr()->success('success');
            }else{
                toastr()->error('Something is wrong!');
            }
        }
        return Redirect(route('super_admin.AllCompanies'));
    }
}
