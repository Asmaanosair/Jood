<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    function index(){
        return view('main');
    }
    function all(){
        $data= DB::table('products')
            ->Join('product_branch', 'products.id', '=', 'product_branch.product_id')
            ->selectRaw('products.id,products.product, SUM(product_branch.amount) as amounts')
            ->groupBy('products.id','products.product')
            ->get();
        return  response()->json($data);
    }
}
