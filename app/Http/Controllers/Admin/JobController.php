<?php

namespace App\Http\Controllers\Admin;

use App\JobBoard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    // job offer
    public function JobOffer(Request $request){

        $jobs = JobBoard::orderBy('id', 'DESC')->paginate(8);

        if ($request->ajax()) {

            return view('admin.job.jobmore', compact('jobs'));
        }
        return view('admin.job.job-offer',compact('jobs'));
    }
}
