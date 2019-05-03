<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeUsers extends Model
{
    protected $table = 'type_users';
  	protected $fillable = ['id', 'id_user','id_type'];
  	protected $guarded = ['id'];
}
