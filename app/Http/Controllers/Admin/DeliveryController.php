<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentMethod;
use App\User;
use DB;
use Illuminate\Http\Request;


class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(){
        return view('main');
    }
    public function show(){
      $user=User::where('role',3)->get();
      return response()->json($user);
    }
//    public function ShowOrders($id){
//        $delivery_orders= DB::table('delivery_orders')->where('user_id',$id)->get();
//        $data=[];
//        foreach ($delivery_orders as $row){
//            $order=Order::findOrFail($row->order_id);
//            $user=$order->user;
//            $product=$order->Product;
//            array_push($data,$order);
//        }
//        return response()->json($data);
//    }
            public function ShowOrders($id){
                $delivery_orders= DB::table('delivery_orders')->where('user_id',$id)->get();
                $data=[];
                foreach ($delivery_orders as $row){
                    $order = DB::table('orders')
                        ->join('payment_methods', 'payment_methods.id', '=', 'orders.payment_method_id')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select( 'payment_methods.name as payment','orders.*','users.name','users.phone')->where(['orders.status'=>2,'orders.id'=>$row->order_id])
                        ->get();
                    array_push($data,$order);
                }
                return response()->json(value($data));
            }
            public function Details($id){
                    $order=Order::findOrFail($id);
                    $user=User::findOrFail($order->user_id);
                    $payment=PaymentMethod::findOrFail($order->payment_method_id);
                    $product = DB::table('order_product')
                        ->join('orders', 'order_product.order_id', '=', 'orders.id')
                        ->join('products', 'products.id', '=', 'order_product.product_id')
                        ->select( 'products.product','products.price','order_product.*')->where(['orders.id'=>$id])
                        ->get();
                    $products=value($product);

                return response()->json(compact('order','user','products','payment'));
            }

}
