<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_detail extends Model
{
    protected $table = 'product_detail';
    protected $fillable = ['id','product_id','color_id','size_id','quantity','created_at','updated_at'];
    public function products(){
    	return $this->belongsTo('App\Product');
    }
     
}
