<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    protected $table = 'kinds';
    protected $fillable = ['id','name','product_id','created_at','updated_at'];
}
