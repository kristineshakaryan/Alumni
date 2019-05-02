<?php

use Illuminate\Database\Seeder;
use App\School;

class SchoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $schools = new School;
        $schools->name = 'School 1';
        $schools->logo = 'default.png';
        $schools->background_image = 'background.png';
        $schools->save();
        //
        $schools = new School;
        $schools->name = 'School 2';
        $schools->logo = 'default.png';
        $schools->background_image = 'background.png';
        $schools->save();
        //
        $schools = new School;
        $schools->name = 'School 3';
        $schools->logo = 'default.png';
        $schools->background_image = 'background.png';
        $schools->save();
        //
        $schools = new School;
        $schools->name = 'School 4';
        $schools->logo = 'default.png';
        $schools->background_image = 'background.png';
        $schools->save();
        //
        $schools = new School;
        $schools->name = 'School 5';
        $schools->logo = 'default.png';
        $schools->background_image = 'background.png';
        $schools->save();
    }
}
