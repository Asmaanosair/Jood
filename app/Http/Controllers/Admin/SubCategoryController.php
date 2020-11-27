<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SubCategoryController extends Controller
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
        $subCategories= DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.category')
            ->get();
        $categories=Category::all();
        return response()->json(compact('subCategories','categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|max:255',
            'categoryId' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ]);
        $subCategory = new SubCategory();
        if($request->image!=null)
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);

            $subCategory->image=$path.$filName;
        }
        $subCategory->name= $request->name;
        $subCategory->category_id= $request->categoryId;
        $subCategory->save();
        return response()->json($subCategory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=SubCategory::find($id)->Product;

        return response()->json($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subCategory=SubCategory::find($id);
        return response()->json([$subCategory]);
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
            'name' => 'required|string|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ]);
        $subCategory =SubCategory::find($id);
        {
            $filName=time().".".$request->image->getClientOriginalExtension();
            $path='adminassets/images/';
            $imagePath= $request->file('image')->move($path,$filName);
            $subCategory->image=$path.$filName;
        }
        $subCategory->name= $request->name;
        $subCategory->category_id= $request->categoryId;
        $subCategory->save();
        return response()->json($subCategory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->delete();
        return response()->json(' successfully deleted');
    }
    public function ChangeVisibility($id)
    {
            $subCategory = SubCategory::find($id);
            if ($subCategory->visibility == 0) {
                $count=SubCategory::all()->where('visibility',1)->count();
                if($count==3) {
                    $message = ' عفوا لا يمكن اضافته لان العدد المسموح بيه 3';
                    return response()->json($message);
                }
                $subCategory->visibility = 1;
            } else {
                $subCategory->visibility = 0;
            }
            $subCategory->save();
            $message=' تمت  بنجاح';
            return response()->json($message);


    }
}
