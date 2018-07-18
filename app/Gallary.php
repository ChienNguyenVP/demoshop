<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table = 'gallary_images';
    protected $fillable = ['id','product_id','link','created_at','updated_at'];
    public function products(){
    	return $this->belongsTo('App\Product');
    }
}
