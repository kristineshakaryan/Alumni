<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobOfTheUser extends Model
{
    //
    protected $table = 'job_of_the_user';

    public function job()
    {
        return $this->belongsTo('App\JobBoard','job_id');
    }
}
