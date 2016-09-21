<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey='idestado';
    protected $fillable = ['idstado','nombre_estado'];
    protected $hidden = ['password', 'remember_token'];

}
