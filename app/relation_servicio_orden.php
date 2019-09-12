<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relation_servicio_orden extends Model
{
    protected $table = 'relation_servicio_orden';
    protected $fillable = ['id','id_orden','id_servicio'];
    protected $guarded = ['id'];
}
