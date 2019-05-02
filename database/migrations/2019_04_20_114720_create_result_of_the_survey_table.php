<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultOfTheSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_of_the_survey', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('survey_type_id');
            $table->integer('survey_id');
            $table->integer('questions_id');
            $table->integer('user_id');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_of_the_survey');
    }
}
