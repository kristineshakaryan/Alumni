<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobBoard extends Model
{
    //
    protected $table = 'job_board';

    const status_inactive = 0;
    const status_active = 1;

    public function chooseSchool()
    {
        return $this->belongsTo('App\School','school_id');
    }

    public function chooseUser()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
