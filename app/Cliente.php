<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'idcliente';
    protected $fillable = ['idcliente','nombre','dni_ruc','telefono','direccion'];
}
