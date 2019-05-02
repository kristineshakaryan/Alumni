<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $table = 'school';

    public function chooseDegree()
    {
        return $this->HasMany('App\DegreeOfTheSchool','school_id');
    }
    public function checkifBusy()
    {
        return $this->belongsTo('App\SchoolOfTheGroup','id' , 'school_id');
    }
    public function GetDegree()
    {
        return $this->HasMany('App\DegreeOfTheSchool','school_id' );
    }
    public function GetUsers()
    {
        return $this->HasMany('App\SchoolOfTheUser','school_id' );
    }
    public function GetAdmins()
    {
        return $this->HasMany('App\AdminOfTheSchool','school_id' );
    }
    public function GetUsersOfTheSchool()
    {
        return $this->HasMany('App\SchoolOfTheUser','school_id' );
    }
    public function GetSurveyInfo()
    {
        return $this->belongsTo('App\Survey','survey_id','id' );
    }
}
