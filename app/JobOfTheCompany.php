<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOfTheCompany extends Model
{
    //
    protected $table = 'job_of_the_company';
    public function GetJobInfo()
    {
        return $this->belongsTo('App\JobBoard','job_id');
    }
}
