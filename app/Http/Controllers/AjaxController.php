<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    function index(Request $request){
        $data = Product::find($request->id);
        return response()->json(['data'=>$data]);
    }
    function Delivery(Request $request){
        return $request->all();
    }
}
