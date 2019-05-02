<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolOfTheUser extends Model
{
    //
    protected $table = 'school_of_the_user';

    public function school()
    {
        return $this->belongsTo('App\School','school_id');
    }
    public function GetUserInfo()
    {
        return $this->belongsTo('App\User','user_id' , 'id');
    }
    public function GetDegreeId()
    {
        return $this->HasMany('App\DegreeOfTheUser','user_id','user_id' );
    }
}
