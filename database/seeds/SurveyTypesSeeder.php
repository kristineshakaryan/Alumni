<?php

use Illuminate\Database\Seeder;
use App\SurveyTypes;

class SurveyTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $SurveyTypes = new SurveyTypes();
        $SurveyTypes->name = 'Survey For Ussual Register';
        $SurveyTypes->save();
        //
        $SurveyTypes = new SurveyTypes();
        $SurveyTypes->name = 'Survey For Linkedin Register';
        $SurveyTypes->save();
        //
        $SurveyTypes = new SurveyTypes();
        $SurveyTypes->name = 'SurveyType 3';
        $SurveyTypes->save();
        //
        $SurveyTypes = new SurveyTypes();
        $SurveyTypes->name = 'SurveyType 4';
        $SurveyTypes->save();
    }
}
