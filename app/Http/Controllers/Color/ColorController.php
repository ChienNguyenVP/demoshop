<?php

namespace App\Http\Controllers\Color;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\color;
use Yajra\Datatables\Datatables;

class ColorController extends Controller
{
    public function index(){
    	return view('color.index');
    }
    public function datatableListColor(){
    	return Datatables::of(color::query())->addColumn('action', function ($color) {
                return '<button class="btn-sm btn-info"><i class="fa fa-eye" aria-hidden2="true"></i></button> <button class="btn-sm btn-danger" data-id ="'.$color->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';             
            })
            // ->editColumn('code', '<div style="background:'.$code' ; width: 60px;"></div>');
            ->make(true);
    }
    public function store(Request $request){
    	$data = $request->all();
    	$post = color::create($data);
    	 return response()->json([
            'data' => $post
        ],200);
    }
    public function delete($id){
    	color::find($id)->delete();
    }
}
