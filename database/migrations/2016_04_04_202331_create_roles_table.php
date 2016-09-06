<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre_rol', 40);
            $table->timestamps();
        });

        /*if (Schema::hasTable('users')) {
            Schema::table('users',function(Blueprint $table){
                $table->foreign('idrol')
                  ->references('id')->on('roles')
                  ->onUpdate('cascade');
            });
        }*/    
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('users');
        Schema::drop('roles');
    }
}
