<?php

use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'nombre_estado'  	=> 'Abierta'
        ]);
        DB::table('estados')->insert([
            'nombre_estado'  	=> 'En Curso'
        ]);
        DB::table('estados')->insert([
            'nombre_estado'  	=> 'Cerrada'
        ]);
    }
}
