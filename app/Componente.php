<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $primaryKey = 'idcomponente';
    protected $table = 'componentes';
    protected $fillable = ['idcomponente','componente'];
}
