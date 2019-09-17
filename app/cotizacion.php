<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cotizacion extends Model
{
    protected $table = 'cotizacion';
    protected $fillable = ['id', 'name','email','telefono','mensaje'];
    protected $guarded = ['id'];
}
