<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idincidencia');
            $table->integer('idcliente');
            $table->string('marca', 40);
            $table->string('modelo', 40);
            $table->string('serie', 40);
            $table->string('descripcion', 200);
            $table->string('tipo', 40);
            $table->string('condicion', 40);
            $table->string('prioridad', 40);
            $table->integer('estado');
            $table->integer('idtecnico');
            $table->string('diagnostico',200);
            $table->string('descripcion_tecnico',200);
            $table->dateTime('fecha_curso');
            $table->dateTime('fecha_completa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('incidencia');
    }
}
