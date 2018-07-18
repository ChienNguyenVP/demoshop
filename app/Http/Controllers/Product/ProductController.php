<?php

namespace App\Http\Controllers\product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Kind;
use App\color;
use App\sizes;
use App\provider;
use App\Gallary;
use Storage;
use App\Product_detail;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    public function index(){
    	$product = Product::orderBy('id', 'desc')->get();
        $kind = Kind::all();
        $provider = provider::all();
        $color = color::all();
        $size = sizes::all();

        // dd($size);
    	return view('product.index',[
            'product' => $product,
            'kind' => $kind,
            'provider' => $provider,
            'sizes' => $size, 
            'colors' => $color,
        ]);
    }
    public function store(Request $request){
        // return response()->json($request->provider)
        $pro = array();
        $pro['name'] = $request['name'];
        $pro['description'] = $request['description'];
        $pro['origin_prime'] = $request['origin_prime'];
        $pro['sale_prime'] = $request['sale_prime'];
        $pro['code'] = time();
        $pro['slug'] = str_slug($request['name']);
        $pro['provider_id'] = $request['provider'];

        // return response()->json($pro['code']);

        $pro = Product::create($pro);

        $img = array();
        if($files = $request->file('uploadFile')){
            foreach ($files as $key =>$file) {
                $temp['link'] = Storage::disk('local')->put('public/images/product',$file);
                $temp['product_id'] = $pro->id;
                 
               $img[] =  Gallary::create($temp);
            }
        }
        $detail = array();
        $detail['product_id'] = $pro->id;
        $colors = $request->color;
        $sizes = $request->size;
        $quantity = $request->quantity;
        foreach ($colors as $key => $color) {
            $detail['color_id'] = $color;
            $detail['size_id'] = $sizes[$key];
            $detail['quantity'] = $quantity[$key];
            $check = Product_detail::where('product_id', $pro->id)->where('color_id', $color)->where('size_id', $sizes[$key])->first();
            if(!$check){

             Product_detail::create($detail);
            }else{
                Product_detail::where('id', $check->id)->update(['quantity'=>$quantity[$key]]);
            }
        }      
       
        return response()->json($img);
    }
    public function datatableListProduct(){
    	return Datatables::of(Product::query())->addColumn('action', function ($product8) {
                return '<button class="btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"><a href=""></a></i></button>  <button class="btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"><a href=""></a></i></button>  <button class="btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"><a href=""></a></i></button>';             
            })
            ->rawColumns(['description', 'action'])
            ->make(true);
    }
}
