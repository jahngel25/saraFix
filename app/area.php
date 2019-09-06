<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $table = 'area';
    protected $fillable = ['id','name','description','img', 'texto', 'img_inter', 'status'];
    protected $guarded = ['id'];
}
