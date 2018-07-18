<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Product_detail;
use App\Gallary;
use App\sizes;
use App\Kind;
class HomeController extends Controller
{
    public function index(){
    	$product = Product::get();
		return view('shop.index',[
            'products' => $product
            
        ]);
    }
    public function detail($slug){
    	$product = Product::where('slug',$slug)->first();
    	$detail = Product_detail::where('product_id',$product->id)->first();
    	$sizes = $product->sizes;
    	$colors = $product->colors;


    	$img = Gallary::where('product_id',$product->id)->get();
    	return view('shop.detail',[
    		'product' => $product,
    		'detail' => $detail,
    		'img' => $img,
    		'colors'=>$colors,
    		'sizes' => $sizes
    	]); 
    }
}
