<?php

use Illuminate\Database\Seeder;
use App\GraduationYear;

class GraduationYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1970 ; $i <= 2025 ; $i++){
            //
            $GraduationYear = new GraduationYear;
            $GraduationYear->year = $i;
            $GraduationYear->save();
        }
    }
}
