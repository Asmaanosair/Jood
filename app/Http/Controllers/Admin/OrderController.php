<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {
            $orders = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('users.name', 'orders.*')
                ->get();
            return response()->json($orders);
    }

    public function edit($id)
    {
        $orders=Order::find($id);
        return response()->json([$orders]);
    }
    public function update(Request $request, $id)
    {
        $orders =Order::find($id);
        $orders->status= $request->status;
        $orders->save();
        return response()->json($orders);
    }
    public function status()
    {
        return view('main');
    }
    public function getOrders($status)
    {
        $orders= DB::table('orders')
            ->join('users', 'orders.user_id', '=','users.id')
            ->where('orders.status',$status)
            ->select('users.name', 'orders.*')
            ->get();
        return response()->json($orders);
    }
}
