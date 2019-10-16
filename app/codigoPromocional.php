<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class codigoPromocional extends Model
{
    protected $table = 'codigos_promocionales';
    protected $fillable = ['id','codigo','fechaVencimiento','status'];
    protected $guarded = ['id'];
}
