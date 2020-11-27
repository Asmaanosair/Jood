<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;


/**
 * @group  User
 *
 * APIs for User
 *  @urlParam {{ /register }} required name & email & phone Example: NAME @ example@example.com & 123456789
 *  @urlParam {{ /verification/id/codeph}} required The ID of user & verification code of phone Example: 1 & 123456

 */
class UserController extends Controller
{
    public function Register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'string|min:8',
        ]);

        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'code' => '123456',
                'role' => '1',
                'password' => Hash::make($request->get('password')),

            ]);

            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }
    public function VerificationCode($id,$code)
    {
        try {
            $user=User::find($id);
            if($code!==$user->code){
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => ['message' => 'Invalid Code'],
                ], 400);
            }
            $user->isVerified=1;
            $user->save();
            $token =JWTAuth::fromUser($user);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>compact('user','token') ,

            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }

    }
    public function Login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required|numeric',
        ]);

        try {
            if ($validation->fails()) {
                $errors = $validation->errors();
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'error_message' => $errors
                ], 400);
            }
            $user=User::where('phone',$request->get('phone'))->where('isVerified','1')->first();
            if(!$user){
                return response()->json([
                    'code' => '0',
                    'status' => 'The User Not Found',
                    'data' => ['message' => 'The User Not Found'],

                ], 401);
            }
            $token =JWTAuth::fromUser($user);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' =>compact('token','user') ,
            ], 201);

        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }


    public function Profile()
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => 'User Not Found',

                ], 400);
            }
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => '0',
                'status' => 'failed',
                'data' => ['message' => $exception->getMessage()],

            ], 500);
        }
    }




    public function editProfile(Request $request)
    {
        try {
            $user = auth('api')->user();
            if (!$user) {
                return response()->json([
                    'code' => '0',
                    'status' => 'error',
                    'data' => 'User Not Found',

                ], 400);
            }
            $data = $request->except('role', 'isVerified','code');
            $user->update($data);
            return response()->json([
                'code' => '1',
                'status' => 'success',
                'data' => $user,

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
