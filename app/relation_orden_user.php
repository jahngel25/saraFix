<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relation_orden_user extends Model
{
    protected $table = 'relation_orden_user';
    protected $fillable = ['id','id_user','id_orden'];
    protected $guarded = ['id'];
}
