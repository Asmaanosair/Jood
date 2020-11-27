<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Product;
use App\Size;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $colors=Color::all();
        $sizes=Size::all();
        $products=Product::with('Color','Size','SubCategory')->get();
        return response()->json(compact('products','sizes','colors'));

    }
    public function Details()
    {
        return view('main');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $colors=Color::all();
       $sizes=Size::all();
       $subCategories=SubCategory::all();
       return response()->json(compact('sizes','colors','subCategories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required',
            'subCategoryId' => 'required',
        ]);
        $product = new Product();
        $product->product= $request->product;
        $product->description= $request->description;
        $product->sub_category_id= $request->subCategoryId;
        $product->price= $request->price;
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $product->image=$path.$filName;
        }
        if($request->video!=null)
        {
            $filName=time().".".$request->video->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('video')->move($path,$filName);

            $product->video=$path.$filName;
        }
        $product->save();
        if($request->checkedSize!=null) {
            $product->Size()->attach(explode(',', $request->checkedSize));
        }
        if($request->checkedColor!=null) {
            $product->Color()->attach(explode(',', $request->checkedColor));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        $color=$product->Color;
        $size=$product->Size;
        $images=$product->ProductImages;
        $subCategory=$product->SubCategory;
        $branch=$product->Branch;
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        $subCategory=SubCategory::all();
        return response()->json(compact('product','subCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'product' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required',
            'subCategoryId' => 'required',
        ]);
        $product =Product::find($id);
        $product->product= $request->product;
        $product->description= $request->description;
        $product->sub_category_id= $request->subCategoryId;
        $product->price= $request->price;
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);
            $product->image=$path.$filName;
        }
        if($request->video!=null)
        {
            $filName=time().".".$request->video->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('video')->move($path,$filName);

            $product->video=$path.$filName;
        }
            $product->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
