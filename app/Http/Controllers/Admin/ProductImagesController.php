<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProductImagesController extends Controller
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
        $productImages=Product::find($id)->ProductImages;
        return response()->json($productImages);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
        ]);
        $product=$request->id;
        if($request->images!=null)
        {
            $filName=time().".".$request->images->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('images')->move($path,$filName);
                $image= new ProductImage();
                $image->image = $path.$filName;
                $image->product_id = $product;
                $image->save();
            }

        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProductImage::find($id);
        $image->delete();

    }

}
