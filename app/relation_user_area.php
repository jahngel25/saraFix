<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class relation_user_area extends Model
{
    protected $table = 'relation_user_area';
    protected $fillable = ['id','id_user','id_area'];
    protected $guarded = ['id'];
}
