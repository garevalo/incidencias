<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $primaryKey = 'idincidencia';
    protected $table = 'incidencia';
    protected $fillable = ['idincidencia',
                            'idcliente',
                            'marca',
                            'modelo',
                            'serie',
                            'descripcion',/*cambiar por descripcion*/
                            'tipo',
                            'condicion',
                            'prioridad',
                            'estado',
                            'idtecnico',
                            'diagnostico',
                            'descripcion_tecnico'];
}
