<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Http\Request;
use App\Product;

class ProductSizeController extends Controller
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
        $productSize=Product::find($id)->Size;
        return response()->json($productSize);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'checkedSize' => 'required',
        ]);
        $product= Product::find($request->id);
        foreach (explode(',', $request->checkedSize) as $id){
            if (!($product->Size->contains($id))) {

                $product->Size()->attach($id);
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
        $size=Size::find($id);
        $product=Product::find($product);
        $product->Size()->detach($size);

    }

}
