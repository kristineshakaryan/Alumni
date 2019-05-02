<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyOfTheSchool extends Model
{
    //
    protected $table = 'surveys_of_the_school';
    public function GetSurveyInfo()
    {
        return $this->belongsTo('App\Survey','survey_id');
    }
}
