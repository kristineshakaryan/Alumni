<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'company';
    public function GetSchoolInfo()
    {
        return $this->belongsTo('App\School','school_id');
    }
}
