<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
/**
 * @group  Category & SubCategory
 *
 * APIs for Category & SubCategory
 *  @urlParam {{ /categories }}
 *  @urlParam {{ /sub_categories/id/}} required The ID of Category Example:1

 */
class CategoryController extends Controller
{
    public function Home(){

        try {
            $data=Product::orderBy('id','desc')->select('id','product','image')->take(3)->get();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $data,

            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],

            ], 500);
        }
    }
 public function Categories(){
     try {
         $category=Category::with('SubCategory')->get();
         return response()->json([
             'code' => '1',
             'status' => 'success',
             'data' => $category,
         ], 200);

     }catch (\Exception $exception){
         return response()->json([
             'code' => '0',
             'status' => 'failed',
             'data' => ['message'=>$exception->getMessage()],
         ], 500);
     }
 }
    public function Sections(){
        try {
            $subCategory=SubCategory::with('Products')->where('visibility',1)->take(10)->get();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $subCategory,
            ], 200);

        }catch (\Exception $exception){
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message'=>$exception->getMessage()],
            ], 500);
        }
    }
    public function SubCategories($id){
        try {
            $subCategories=Category::find($id)->SubCategory;
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $subCategories,

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
