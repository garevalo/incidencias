<?php

use Illuminate\Database\Seeder;

class ComponentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('componentes')->insert([
            'componente'  	=> 'Bateria'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Cargador'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Disco Duro'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Pantalla'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Teclado'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Memoria'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Placa Madre'
        ]);
        DB::table('componentes')->insert([
            'componente'  	=> 'Procesador'
        ]);
    }
}
