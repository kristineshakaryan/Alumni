<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('date_of_launch')->nullable();
            $table->date('date_of_creation')->nullable();
            $table->string('logo');
            $table->string('background_image');
            $table->string('first_name_of_administrative_contact')->nullable();
            $table->string('last_name_of_administrative_contact')->nullable();
            $table->string('email_of_the_administrative_contact')->nullable();
            $table->string('first_name_of_the_person_in_charge_of_alumni')->nullable();
            $table->string('last_name_of_the_person_in_charge_of_alumni')->nullable();
            $table->string('email_of_the_person_in_charge_of_alumni')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('school');
    }
}
