<?php

use Illuminate\Database\Seeder;
use App\JobBoard;

class JobBoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 1';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 2';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 3';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 4';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 5';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
        //
        $JobBoard = new JobBoard;
        $JobBoard->title = 'JobBoard 6';
        $JobBoard->link = 'https://www.google.com/';
        $JobBoard->save();
    }
}
