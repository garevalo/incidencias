<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidenciaComponente extends Model
{
    protected $primaryKey = 'id_inc_comp';
    protected $table = 'incidencia-componente';
    protected $fillable = ['id_inc_comp','idcomponente','idincidencia','serie'];
}
