<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relationTypeUsers extends Model
{
    protected $table = 'relation_typeuser';
  	protected $fillable = ['id', 'id_user','id_type','status'];
  	protected $guarded = ['id'];
}
