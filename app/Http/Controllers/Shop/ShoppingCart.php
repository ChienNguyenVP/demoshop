<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Cart;

class ShoppingCart extends Controller
{
	public function cart(Request $request, $id){
		$product = Product::find($id);
		$cartInfo = [
			'id' => $id,
			'name' => $product->name,
			'price' => $product->sale_prime,
			'qty' => $request->quantity,
			'option'=>[
				'color' => $request->color,
				'size' => $request->size
			]	
		]; 
		Cart::add($cartInfo);
		$cart = Cart::content();
		return view('shop.cart',$cart);
	
	}		    
}
