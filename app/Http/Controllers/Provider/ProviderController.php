<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\provider;
use Yajra\Datatables\Datatables;

class ProviderController extends Controller
{
    public function index(){
    	return view('provider.index');
    }
    public function datatableListProvider(){
    	return Datatables::of(provider::query())->addColumn('action', function ($provider) {
                return '<button class="btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button> <button class="btn-sm btn-danger" data-id ="'.$provider->id.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';             
            })
            ->make(true);
    }
    public function store(Request $request){
    	$data = $request->all();
    	$post = provider::create($data);
    	 return response()->json([
            'data' => $post
        ],200);
    }
    public function delete($id){
        provider::find($id)->delete();
    }
}
