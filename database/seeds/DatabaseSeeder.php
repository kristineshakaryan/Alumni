<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(SchoolsSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(SurveyTypesSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(JobBoardTableSeeder::class);
        $this->call(GraduationYearTableSeeder::class);
    }
}
