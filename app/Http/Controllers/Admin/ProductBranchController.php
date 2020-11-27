<?php

namespace App\Http\Controllers\Admin;

use App\Branch;
use App\Product;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductBranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
        return view('main');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subCategories=SubCategory::all();
        $branch=Branch::find($id);
        $productsBranch=$branch->Product;
        return response()->json(compact('productsBranch','subCategories','branch'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'productId' => 'required',
            'amount' => 'required',
        ]);
        $branch = Branch::find($request->id);
        if (!($branch->Product->contains($request->productId))) {
            $branch->Product()->attach($request->productId,['amount' =>$request->amount]);
        }
        $branch->Product()->updateExistingPivot($request->productId,['amount' =>$request->amount]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$product)
    {
        $branch=Branch::find($id);
        $product=Product::find($product);
        $branch->Product()->detach($product);

    }
}
