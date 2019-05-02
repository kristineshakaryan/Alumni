<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('city')->nullable();
            $table->string('graduation_year_id')->nullable();
            $table->string('avatar')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->date('date_of_import')->nullable();
            $table->string('small_description')->nullable();
            $table->tinyInteger('type')->default('1');
            $table->tinyInteger('mentorat')->default('0');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('linkedin')->default('0');
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
