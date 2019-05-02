<?php

namespace App\Http\Controllers\user;

use App\JobBoard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    // job offer
    public function JobOffer(Request $request){

        $jobs = JobBoard::paginate(8);

        if ($request->ajax()) {

            return view('user.job.jobmore', compact('jobs'));
        }
        return view('user.job.job-offer',compact('jobs'));
    }
}
