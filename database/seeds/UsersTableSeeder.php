<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new User;
        $admin->first_name = 'Super';
        $admin->last_name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->avatar = 'default.jpg';
        $admin->date_of_import = '2019-03-02';
        $admin->password = Hash::make(123456);
        $admin->type = User::super_admin;
        $admin->status = User::status_active;
        $admin->save();
        //Remove after test
        $admin = new User;
        $admin->first_name = 'admin1';
        $admin->last_name = 'admin1';
        $admin->email = 'admin1@gmail.com';
        $admin->date_of_import = '2018-04-30';
        $admin->avatar = 'default.jpg';
        $admin->password = Hash::make(123456);
        $admin->type = User::admin;
        $admin->status = User::status_active;
        $admin->save();
        //
        $admin = new User;
        $admin->first_name = 'User 1';
        $admin->last_name = 'username 1';
        $admin->email = 'user1@gmail.com';
        $admin->date_of_import = '2018-02-30';
        $admin->avatar = 'default.jpg';
        $admin->password = Hash::make(123456);
        $admin->type = User::user;
        $admin->status = User::status_active;
        $admin->save();
        //
        $admin = new User;
        $admin->first_name = 'User 2 ';
        $admin->last_name = 'username 2';
        $admin->date_of_import = '2018-01-30';
        $admin->email = 'user2@gmail.com';
        $admin->avatar = 'default.jpg';
        $admin->password = Hash::make(123456);
        $admin->type = User::user;
        $admin->status = User::status_active;
        $admin->save();
        //
        $admin = new User;
        $admin->first_name = 'admin 2';
        $admin->last_name = 'admin 2';
        $admin->email = 'admin2@gmail.com';
        $admin->date_of_import = '2018-11-30';
        $admin->avatar = 'default.jpg';
        $admin->password = Hash::make(123456);
        $admin->type = User::admin;
        $admin->status = User::status_active;
        $admin->save();
        //
        $admin = new User;
        $admin->first_name = 'admin 3';
        $admin->last_name = 'admin 3';
        $admin->email = 'admin3@gmail.com';
        $admin->avatar = 'default.jpg';
        $admin->date_of_import = '2018-11-12';
        $admin->password = Hash::make(123456);
        $admin->type = User::admin;
        $admin->status = User::status_active;
        $admin->save();
    }
}
