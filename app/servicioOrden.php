<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicioOrden extends Model
{
    protected $table = 'orden_servicio';
    protected $fillable = ['id','description','total', 'id_codigo', 'id_user', 'telefono','address','date'];
    protected $guarded = ['id'];
}
