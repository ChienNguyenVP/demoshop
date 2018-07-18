<?php

namespace App\Http\Controllers\Size;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sizes;
use Yajra\Datatables\Datatables;

class SizeController extends Controller
{
       public function index(){
    	return view('size.index');
    }
    public function datatableListSize(){
    	return Datatables::of(sizes::query())->addColumn('action', function ($size) {
                return '<button class="btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn-sm btn-danger" data-id ="'.$size->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';             
            })
            ->make(true);
    }
    public function store(Request $request){
    	$data = $request->all();
    	$post = sizes::create($data);
    	 return response()->json([
            'data' => $post
        ],200);
    }
    public function delete($id){
    	sizes::find($id)->delete();

    }
}
