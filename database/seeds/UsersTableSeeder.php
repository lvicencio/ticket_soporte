<?php

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
        User::create([
            'name'=>'Luis Vicencio',
            'email'=> 'lvicencio@gmail.com',
            'password'=> bcrypt('123456'),
            'role'=> 0
        ]);
        User::create([
            'name'=>'Jose',
            'email'=> 'jose@gmail.com',
            'password'=> bcrypt('123456'),
            'role'=> 1
        ]);
        User::create([
            'name'=>'Tukulito',
            'email'=> 'tukulito@gmail.com',
            'password'=> bcrypt('123456'),
            'role'=> 2
        ]);
    }
}
