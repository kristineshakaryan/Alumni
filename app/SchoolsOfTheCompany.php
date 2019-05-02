<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolsOfTheCompany extends Model
{
    //
    protected $table = 'schools_of_the_company';

    public function GetSchoolInfo()
    {
        return $this->belongsTo('App\School','school_id');
    }
}
