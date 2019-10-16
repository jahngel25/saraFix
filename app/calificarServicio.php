<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calificarServicio extends Model
{
    protected $table = 'calificacion';
    protected $fillable = ['id','description','puntaje', 'id_orden', 'type'];
    protected $guarded = ['id'];
}
