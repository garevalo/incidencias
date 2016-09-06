<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'  	=> 'admin',
            'apellido'  => 'admin',
            'usuario'   => 'admin', 
            'email' 	=> 'admin@gmail.com',
            'image'     => '/avatars/profile-pic.jpg',
            'password'  => bcrypt('secret'),
            'idrol'		=> '1'
        ]);
    }
}
