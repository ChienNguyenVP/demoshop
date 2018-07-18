<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\color;
use App\provider;
use App\Kind;
use App\Product;
use App\sizes;
use App\Product_detail;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','code','provider_id','origin_prime','name','sale_prime','description','content','color_id','size_id','slug','created_at','updated_at']; 
     public function provider(){
    	return $this->belongsTo('App\provider','provider_id','id');
    }
     public function color(){
    	return $this->belongsTo('App\color','color_id','id');
    }
    public function gallarys(){
    	return $this->hasMany('App\Gallary');
    }

    public function anh(){
        return $this->hasMany('App\Gallary')->first();
    }
    public function details(){
        return $this->hasMany('App\Product_detail');
    }

    public function colors(){
        return $this->belongsToMany('App\color','product_detail', 'product_id', 'color_id');
    }
    public function sizes(){
        return $this->belongsToMany('App\sizes','product_detail', 'product_id', 'size_id');
    }
   
}
