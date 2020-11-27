<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    function show($id){
        $product=Product::find($id);
        return response()->json($product);

    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sale' => 'required',
            'price' => 'required|string',
        ]);
        $sale = Product::find($id);
        $sale->price_sale= $request->price;
        $sale->sale= $request->sale;
        $sale->save();

    }
}
