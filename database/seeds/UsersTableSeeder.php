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
            'idrol'		=> '1',
            'estado'    => '1'
        ]);

        DB::table('users')->insert([
            'name'  	=> 'tecnico1',
            'apellido'  => 'tecnico',
            'usuario'   => 'tecnico1',
            'email' 	=> 'tecnico@gmail.com',
            'image'     => '/avatars/profile-pic.jpg',
            'password'  => bcrypt('secret'),
            'idrol'		=> '2',
            'estado'    => '1'
        ]);

        DB::table('users')->insert([
            'name'  	=> 'tecnico2',
            'apellido'  => 'tecnico2',
            'usuario'   => 'tecnico2',
            'email' 	=> 'tecnico2@gmail.com',
            'image'     => '/avatars/profile-pic.jpg',
            'password'  => bcrypt('secret'),
            'idrol'		=> '2',
            'estado'    => '1'
        ]);

        DB::table('users')->insert([
            'name'      => 'recepcionista',
            'apellido'  => 'recepcionista',
            'usuario'   => 'recepcionista',
            'email'     => 'recepcionista@gmail.com',
            'image'     => '/avatars/profile-pic.jpg',
            'password'  => bcrypt('secret'),
            'idrol'     => '3',
            'estado'    => '1'
        ]);
    }
}
