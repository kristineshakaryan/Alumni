<?php

use Illuminate\Database\Seeder;
use App\Groups;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = new Groups;
        $groups->name = 'Group 1';
        $groups->logo = 'default.png';
        $groups->save();
        //
        $groups = new Groups;
        $groups->name = 'Group 2';
        $groups->logo = 'default.png';
        $groups->save();
        //
        $groups = new Groups;
        $groups->name = 'Group 3';
        $groups->logo = 'default.png';
        $groups->save();
        //
        $groups = new Groups;
        $groups->name = 'Group 4';
        $groups->logo = 'default.png';
        $groups->save();
        //
        $groups = new Groups;
        $groups->name = 'Group 5';
        $groups->logo = 'default.png';
        $groups->save();
    }
}
