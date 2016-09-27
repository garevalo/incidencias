<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
    	DB::table('roles')->insert([
            'nombre_rol'  	=> 'admin'
        ]);
        DB::table('roles')->insert([
            'nombre_rol'  	=> 'tecnico'
        ]);
        DB::table('roles')->insert([
            'nombre_rol'    => 'recepcionista'
        ]);
    }
}
