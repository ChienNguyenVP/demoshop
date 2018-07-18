<?php

namespace App\Http\Controllers\Kind;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kind;
use Yajra\Datatables\Datatables;

class KindController extends Controller
{
     public function index(){
    	return view('kind.index');
    }
    public function datatableListKind(){
    	return Datatables::of(Kind::query())->addColumn('action', function ($kind) {
                return '<button class="btn-sm btn-info"><i class="fa fa-eye" aria-hidden2="true"></i></button> <button class="btn-sm btn-danger" data-id ="'.$kind->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';             
            })
            // ->editColumn('code', '<div style="background:'.$code' ; width: 60px;"></div>');
            ->make(true);
    }
    public function store(Request $request){
    	$data = $request->all();
    	$post = Kind::create($data);
    	 return response()->json([
            'data' => $post
        ],200);
    }
    public function delete($id){
    	Kind::find($id)->delete();
    }
}
