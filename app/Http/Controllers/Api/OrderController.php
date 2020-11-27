<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Order;
use App\PaymentMethod;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function paymentMethods(){

        try {
            $data=PaymentMethod::all()->where('active',1);
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
    public function Orders(){
        try {
            $user = auth('api')->user()->id;
            $allData=[];
            $order=User::findOrFail($user)->order;
            foreach ($order as $row){
                $order=Order::find($row->id);
                if($row->status==0){
                    $order['status']='طلب جديد' ;
                }elseif ($row->status==1){
                    $order['status']=' تمت الموافقه ' ;
                }elseif ($row->status==3) {
                    $order['status'] = '  تم التوصيل  ';
                }
                else{
                    $order['status'] = '  تم رفض الطلب  ';
                }
                    $order['payment_method']=PaymentMethod::findOrFail($row->payment_method_id)->name;
                $product=$order->Product;
                $product->makeHidden(['video','description','sub_category_id']);
  array_push($allData,$order);
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$allData,

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
