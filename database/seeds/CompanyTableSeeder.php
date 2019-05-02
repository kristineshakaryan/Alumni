<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $Company = new Company;
        $Company->name = 'Company 1';
        $Company->first_name = 'first name 1';
        $Company->last_name = 'last name 1';
        $Company->logo = 'default.png';
        $Company->save();
        //
        $Company = new Company;
        $Company->name = 'Company 2';
        $Company->first_name = 'first name 2';
        $Company->last_name = 'last name 2';
        $Company->logo = 'default.png';
        $Company->save();
        //
        $Company = new Company;
        $Company->name = 'Company 3';
        $Company->first_name = 'first name 3';
        $Company->last_name = 'last name 3';
        $Company->logo = 'default.png';
        $Company->save();
    }
}
