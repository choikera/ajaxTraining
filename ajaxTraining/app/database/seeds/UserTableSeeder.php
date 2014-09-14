<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
       DB::table('users')->delete();

        $user = new User;

        $user->id = '1';
        $user->username = 'admin';
        $user->type = 'admin';
        $user->firstname = 'Jan';
        $user->lastname = 'Sarmiento';
        $user->password = Hash::make('password');
        $user->save();
    }
}