<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retiros extends Model
{
    protected $table = 'retiros';
    protected $fillable = ['id','cantidad','status','id_user'];
    protected $guarded = ['id'];
}
