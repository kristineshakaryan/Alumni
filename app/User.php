<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    const user = 1;
    const admin = 2;
    const super_admin = 3;

    const linkedin_login = 1;

    const status_inactive = 0;
    const status_active = 1;

    const mentorat = 1;

    public function chooseColor()
    {
        return $this->belongsTo('App\CategoryOfTheUser','id','user_id');
    }

    public function chooseSchool()
    {
        return $this->HasMany('App\SchoolOfTheUser','user_id');
    }

    public function chooseDegree()
    {
        return $this->HasMany('App\DegreeOfTheUser','user_id');
    }

    public function chooseJob()
    {
        return $this->HasMany('App\JobOfTheUser','user_id');
    }

    public function myJob()
    {
        return $this->HasMany('App\JobBoard','user_id');
    }

    public function myBlog()
    {
        return $this->HasMany('App\BlogPost','user_id');
    }

}

