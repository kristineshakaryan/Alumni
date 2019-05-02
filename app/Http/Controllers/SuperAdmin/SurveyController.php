<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SurveyOfTheSchool;
use App\Questions;
use App\Survey;
use App\Answer;
use Crypt;

class SurveyController extends Controller
{
    //
    public function NewSurvey(){
        return view('super_admin.survey.newsurvey');
    }
    // All Surveys
    public function AllSurveys(){
        $surveys = Survey::all();
        return view('super_admin.survey.allsurveys',compact('surveys'));
    }
    // Delete Survey
    public function DeleteSurvey(Request $request){
        $id = Crypt::decrypt($request->input('id'));
        $Questions = Questions::where('survey_id',$id);
        $Questions->delete();
        $Answer = Answer::where('survey_id',$id);
        $Answer->delete();

        $SurveyOfTheSchool = SurveyOfTheSchool::where('survey_id',$id);
        $SurveyOfTheSchool->delete();

        if ($Survey = Survey::find($id)->delete()) {
            return response(['success' => true]);
        }else{
            return response(['success' => false]);
        }
    }
    // Add Question
    public function AddSurvey(Request $request){
        $name_survey = request('name');
        $surveytype  =  request('surveytype');
        $question    =    request('quest_input');
        $data_type   =   request('data_type');
        $survey = Survey::where('name' , $name_survey)->first();

        if( !$survey) {
            $survey = new Survey;
            $survey->name = $name_survey;
            $survey->survey_type_id = $surveytype;
            $survey->save();
        }
        if ( $question ){
            $Questions            = new Questions;
            $Questions->title     = $question;
            $Questions->type      = $data_type;
            $Questions->survey_id = $survey->id;
            $Questions->save();
        }
        if(request('answers')){
            foreach(request('answers') as $answer){
                if(!empty($answer)){
                    $answers              = new Answer;
                    $answers->title       = $answer;
                    $answers->question_id = $Questions->id;
                    $answers->survey_id   = $survey->id;
                    $answers->save();
                }
            }
        }
        if (request('next_btn')){
            return response(['success' => true , 'survey_name' => $name_survey]);
        }
        else{
            toastr()->success("Done");
            return Redirect::back();
        }
    }
}
