<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    protected $table = 'survey';

    public function GetSurveyType()
    {
        return $this->belongsTo('App\SurveyTypes','survey_type_id');
    }

    public function GetQuestions()
    {
        return $this->HasMany('App\Questions','survey_id' );
    }

}
