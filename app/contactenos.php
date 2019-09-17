<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contactenos extends Model
{
    protected $table = 'contactenos';
    protected $fillable = ['id', 'name','email','telefono','mensaje'];
    protected $guarded = ['id'];
}
