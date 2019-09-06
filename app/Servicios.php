<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicios extends Model
{
    protected $table = 'servicio';
    protected $fillable = ['id','name','description','img','precio', 'id_area'];
    protected $guarded = ['id'];
}
