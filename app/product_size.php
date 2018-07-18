<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_size extends Model
{
    protected $table = 'product_size';
    protected $fillable = ['id','code','name','provider_id','kind_id','origin_prime','sale_prime','description','content','slug','update_at','created_at'];
}
