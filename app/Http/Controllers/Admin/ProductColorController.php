<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;

class ProductColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productColor=Product::find($id)->Color;
        return response()->json($productColor);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'checkedColor' => 'required',
        ]);
        $product = Product::find($request->id);
        foreach (explode(',', $request->checkedColor) as $id){
            if (!($product->Color->contains($id))) {

                $product->Color()->attach($id);
            }

    }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$product)
    {
        $color=Color::find($id);
        $product=Product::find($product);
        $product->Color()->detach($color);

    }

}
