<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    protected $table = 'providers';
    protected $fillable = ['id','name'];

     public function product(){
    	return $this->hasMany('App\Product','provider_id','id');
    }
}
