<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidenciaComponenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencia-componente', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_inc_comp');
            $table->integer('idcomponente');
            $table->integer('idincidencia');
            $table->string('serie',40);
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
        Schema::drop('incidencia-componente');
    }
}
