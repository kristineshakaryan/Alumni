<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultOfTheSurvey extends Model
{
    //
    protected $table = 'result_of_the_survey';

    public function GetSurveyType()
    {
        return $this->belongsTo('App\SurveyTypes','survey_type_id');
    }

    public function GetSurvey()
    {
        return $this->belongsTo('App\Survey','survey_id');
    }

    public function GetQuestion()
    {
        return $this->belongsTo('App\Questions','questions_id');
    }

}
