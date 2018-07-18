<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['id', 'color','code','created_at','updated_at'];

    public function product(){
    	return $this->hasMany('App\Product','color_id','id');
    }
    public function details(){
    	return $this->hasMany('App\Product_detail');
    }

    public function products(){
    	return $this->belongsToMany('App\Product', 'product_detail', 'product_id', 'color_id');
    }
}
