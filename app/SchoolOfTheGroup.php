<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolOfTheGroup extends Model
{
    //
    protected $table = 'school_of_the_group';

    public function ChooseSchoolInfo()
    {
        return $this->belongsTo('App\School','school_id');
    }
    public function GetSchoolInfo()
    {
        return $this->belongsTo('App\School','school_id' );
    }
    public function GetGroupInfo()
    {
        return $this->belongsTo('App\Groups','group_id' );
    }
    public function SchoolOfTheUser()
    {
        return $this->HasMany('App\SchoolOfTheUser','school_id','school_id' );
    }
}
