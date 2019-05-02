<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeOfTheSchool extends Model
{
    //
    protected $table = "degree_of_the_school";

    public function degree()
    {
        return $this->belongsTo('App\Degree','degree_id');
    }
    public function GetUsersOfDegree()
    {
        return $this->HasMany('App\DegreeOfTheUser','degree_id' ,  'degree_id');
    }
}
