<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use  Picqer;

class MyController extends Controller
{
    function index(){
        $produts =  Product::all();
        
        return view('welcome',compact('produts'));
    }
    function store(Request $request){

        $productcode = rand(1000,2000);
        

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes   = $generator->getBarcode($productcode,$generator::TYPE_STANDARD_2_5);

        $product = new Product();
        $product->productname = $request->alldata;
        $product->size = $request->inch;
        $product->weight = $request->kg;
        $product->productid = $productcode;
        $product->barcode = $barcodes;
        $product->save();
        return back();

    }
}
