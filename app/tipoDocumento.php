<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoDocumento extends Model
{
    protected $table = 'tipo_documento';
    protected $fillable = ['id', 'description'];
    protected $guarded = ['id'];
}
