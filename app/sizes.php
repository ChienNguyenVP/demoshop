<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sizes extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['id','size','created_at','updated_at'];

     public function products(){
    	return $this->belongsToMany('App\Product', 'product_detail', 'product_id', 'size_id');
    }
    
}
