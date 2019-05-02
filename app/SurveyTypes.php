<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyTypes extends Model
{
    //
    protected $table = 'survey_types';

    const login = 1;

    public function getSurvey()
    {
        return $this->hasOne('App\Survey','survey_type_id');
    }
}
