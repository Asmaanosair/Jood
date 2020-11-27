<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Products($id,Request $request){
        $lat=$request->get('lat');
        $long=$request->get('long');
        try {
            $branch=Branch::where('lat',$lat)->where('long',$long)->where('availability',1)->first();
            if(empty($branch)){
                $product=Product::where('sub_category_id',$id)->paginate(20);
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' =>$product
                ], 200);
            }
            $products=Branch::find($branch->id)->Product;
           // $products=Product::where('branch_id',$branch->id)->paginate(20);
            $product=Product::where('sub_category_id',$id)->paginate(20);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$product->values(),

            ], 200);
//            $product=SubCategory::find($id)->Product;
//                        return response()->json([
//                'code' => '1',
//                'status' => 'success',
//                'data' =>$product,
//
//            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function Search(Request $request){
        try {
            $products=Product::where([
                ['product', 'LIKE', '%' . $request->search . '%'],

            ])->get();

                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' =>$products
                ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
    public function ProductDetails($id){
        try {
            $product=Product::find($id);
            $color=$product->Color;
            $size=$product->Size;
            $images=$product->ProductImages;
            $subCategory=$product->SubCategory;
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$product,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
}
