<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudad';
    protected $fillable = ['id', 'description','id_departamento'];
    protected $guarded = ['id'];
}
