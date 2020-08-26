<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'Mayra',
        'email'    => 'mayragarciaac@gamil.com',
        'password' => Hash::make('Mayabejita'),
    ));

    User::create(array(
        'name'     => 'admind',
        'email'    => 'a@a.com',
        'password' => Hash::make('123456'),
    ));
}

}

