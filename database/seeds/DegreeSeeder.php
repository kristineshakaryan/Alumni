<?php

use Illuminate\Database\Seeder;
use App\Degree;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Degree = new Degree;
        $Degree->name = 'Degree 1';
        $Degree->save();
        //
        $Degree = new Degree;
        $Degree->name = 'Degree 2';
        $Degree->save();
        //
        $Degree = new Degree;
        $Degree->name = 'Degree 3';
        $Degree->save();
        //
        $Degree = new Degree;
        $Degree->name = 'Degree 4';
        $Degree->save();
        //
        $Degree = new Degree;
        $Degree->name = 'Degree 5';
        $Degree->save();
    }
}
