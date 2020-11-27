<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Order;
use App\Product;
use App\Size;
use App\Color;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class CartController extends Controller
{
    public function AddCart(Request $request)
    {

        try {
            $user = auth('api')->user()->id;
            $check=DB::table('carts')->where('user_id',$user)->where('product_id',$request->product_id)
                ->where('color_id',$request->color_id)->where('size_id',$request->size_id)->get();
            if(count($check)==0){
                $cart=new Cart();
                $cart->product_id=$request->product_id;
                $cart->user_id=$user;
                $cart->color_id=$request->color_id;
                $cart->size_id=$request->size_id;
                $cart->save();
                return response()->json([
                    'code' => '1',
                    'status' => 'success',
                    'data' =>$cart,
                ], 201);
            }else{

                return response()->json([
                    'code' => '0',
                    'status' => 'failed',
                    'data' =>'تمت الاضافه من قبل ',
                ], 500);
            }


        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public function UpdateCart(Request $request)
    {
       try {
//           $id=explode(',',$request['cart_id']);
//           $amount=explode(',',$request['amount']);
            $id=$request['cart_id'];
            $amount=$request['amount'];
            $arrayData=array_combine($id,$amount);
            foreach ($arrayData as $key=>$value){
                $cart=Cart::find($key);
                $cart->amount=$value;
                $cart->save();
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'Message' => 'Updated',
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public function Cart()
    {

        try {
            $user = auth('api')->user()->id;
            $allData=[];
            $cart=User::findOrFail($user)->Cart;
            foreach ($cart as $row){
                $data=Cart::find($row->id);
                $product=$data->Product;
                $size=Size::find($row->size_id);
                $color=Color::find($row->color_id);
                $product->makeHidden(['video','description','sub_category_id']);
                if($color==null){
                    $color=[];
                    $data['color']=$color;
                }else{
                    $data['color']=[$color];
                }
                if($size==null){
                    $size=[];
                    $data['size']=$size;
                }else{
                    $data['size']=[$size];
                }

                array_push($allData,$data);
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$allData,
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public function checkOut(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'payment_method_id' => 'required|numeric',
            'address' => 'required',
        ]);
        $data=$this->Cart()->getData()->data;
        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
      if($data==[]){
          return response()->json([
              'code' => '1',
              'status' => 'success',
              'data' => $data
          ], 201);
      }else {
          $productPrice = [];
          foreach ($data as $row) {
              $product = $row->product->price * $row->amount;
              array_push($productPrice, $product);
          }
          $total = array_sum($productPrice);
          $order = new Order();
          $order->user_id = $row->user_id;
          $order->total = $total;
          $order->payment_method_id = $request->payment_method_id;
          $order->address = $request->address;
          $order->save();
          foreach ($data as $test) {
              if ($test->size == []) {
                  $size = null;
              } else {
                  $size = $test->size[0]->size;
              }
              if ($test->color == []) {
                  $color = null;
              } else {
                  $color = $test->color[0]->color;
              }
              $order->Product()->attach($test->product_id, [
                      'amount' => $test->amount,
                      'size' => $size,
                      'color' => $color
                  ]
              );
              Cart::findOrFail($test->id)->delete();
          }
          return response()->json([
              'code' => '1',
              'status' => 'success',
              'data' => $order
          ], 201);
      }
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public function Delete($id)
    {

        try {

            $cart=Cart::findOrFail($id)->delete();
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>$cart,
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
}
