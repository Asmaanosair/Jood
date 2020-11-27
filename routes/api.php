<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function () {
    Route::post('/register', 'UserController@Register');
    Route::get('/verification/{id}/{code}', 'UserController@VerificationCode');
    Route::post('/login', 'UserController@Login');
    Route::get('/categories', 'CategoryController@Categories');
    Route::get('/sections', 'CategoryController@Sections');
    Route::get('/home', 'CategoryController@Home');
    Route::get('/sub_categories/{id}', 'CategoryController@SubCategories');
    Route::get('/products/{id}', 'ProductController@Products');
    Route::get('/product/{id}', 'ProductController@ProductDetails');
    Route::group(['middleware'=>['jwt.auth']], function (){
        Route::post('/addCart', 'CartController@AddCart');
        Route::get('/get-profile', 'UserController@Profile');
        Route::post('/edit-profile', 'UserController@editProfile');
        Route::post('/cart/{id}', 'CartController@Delete');
        Route::post('/checkOut', 'CartController@checkOut');
        Route::post('/cart', 'CartController@Cart');
        Route::post('/updateCart', 'CartController@UpdateCart');
        Route::get('/payment-method', 'OrderController@paymentMethods');
        Route::get('/orders', 'OrderController@Orders');
        Route::post('/search', 'ProductController@Search');
    });




});
