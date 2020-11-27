<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    /*
     |--------------------------------------------------------------------------
     |  Authentication
     |--------------------------------------------------------------------------
     |
     */
    Route::get('/', 'Auth\LoginController@showLoginForm');
   // Auth::routes(['register' => false]);
    Auth::routes();
    Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerAutologinController@index');
    /*
      |--------------------------------------------------------------------------
      | End Authentication
      |--------------------------------------------------------------------------
      |
      */
    Route::namespace('Admin')->group(function () {



        /*************************************
         *           Main Route              *
         ************************************/

        Route::
       // middleware('auth')->
        get('/{any}', function () {
            return view('main');
        })->where(['any' => 'regions|cities|districts|
        |dashboard|categories|sub_categories|
        |sliders|settings|branches|
        |products|colors|sizes|createProduct|orders|']);


        /*************************************
         *          End Main Route           *
         ************************************/

        /*************************************
         *           Regions Route           *
         ************************************/
        Route::resource('/region', 'RegionController');
        /*************************************
         *           End Regions Route       *
         ************************************/
        /*************************************
         *           City Route           *
         ************************************/
        Route::resource('/city', 'CityController');
        /*************************************
         *           End City Route       *
         ************************************/
        /*************************************
         *           District Route           *
         ************************************/
        Route::resource('/district', 'DistrictController');
        Route::get('/district/{id}/availability', 'DistrictController@ChangeAvailability');
        /*************************************
         *           End District Route       *
         ************************************/
        /*************************************
         *           Category Route           *
         ************************************/
        Route::resource('/category', 'CategoryController');
        /*************************************
         *           End Category Route       *
         ************************************/
        /*************************************
         *           Sub Category Route           *
         ************************************/
        Route::resource('/sub_category', 'SubCategoryController');
        Route::get('/sub_category/{id}/visibility', 'SubCategoryController@ChangeVisibility');
        /*************************************
         *           End SubCategory Route       *
         ************************************/
        /*************************************
         *              Products Route           *
         ************************************/
        Route::resource('/product', 'ProductController');
        Route::get('/productDetails/{id}', 'ProductController@Details');
        Route::get('/EditProduct/{id}', 'ProductController@Details');
        /*************************************
         *           End Products Route       *
         ************************************/
        /*************************************
         *              Products Route           *
         ************************************/
        Route::resource('/productImages', 'ProductImagesController');
        Route::resource('/productColors', 'ProductColorController');
        Route::get('/deleteColors/{id}_{product}', 'ProductColorController@destroy');
        Route::get('/deleteSizes/{id}_{product}', 'ProductSizeController@destroy');
        Route::get('/deleteProduct/{id}_{product}', 'ProductBranchController@destroy');
        Route::resource('/productSizes', 'ProductSizeController');
        Route::resource('/productSale', 'ProductSaleController');
        Route::resource('/branchProduct', 'ProductBranchController');
        Route::get('/branchProducts/{id}', 'ProductBranchController@index');

        /*************************************
         *           End Products Route       *
         ************************************/
        /*************************************
         *           Slider Route           *
         ************************************/
        Route::resource('/slider', 'SliderController');
        /*************************************
         *           End Slider Route       *
         ************************************/
        /*************************************
         *           Setting Route           *
         ************************************/
        Route::resource('/setting', 'SettingController');
        /*************************************
         *           End Setting Route       *
         ************************************/
        /*************************************
         *           Branch Route           *
         ************************************/
        Route::resource('/branch', 'BranchController');
        Route::get('/branch/{id}/availability', 'BranchController@ChangeAvailability');
        /*************************************
         *           End Branch Route       *
         ************************************/
        /*************************************
         *           Color Route           *
         ************************************/
        Route::resource('/color', 'ColorController');
        /*************************************
         *           End Color Route        *
         ************************************/
        /*************************************
         *           Size Route           *
         ************************************/
        Route::resource('/size', 'SizeController');
        /*************************************
         *           End Size Route        *
         ************************************/
        /*************************************
         *           Users Route           *
         ************************************/
        Route::resource('/user', 'UserController');
        Route::get('/users', 'UserController@all');
        /*************************************
         *           End Users Route        *
         ************************************/
        /*************************************
         *           Order Route           *
         ************************************/
        Route::resource('/order', 'OrderController');
        Route::get('/order_status/{status}', 'OrderController@status');
        Route::get('/status/{status}', 'OrderController@getOrders');
        /*************************************
         *           End Order Route        *
         ************************************/
        /*************************************
         *           Order Route           *
         ************************************/
        Route::resource('/delivery', 'DeliveryController');
        Route::get('/delivery/all/{id}', 'DeliveryController@ShowOrders');
        Route::get('/order_details/{id}', 'DeliveryController@index');
        Route::get('/orders_details/{id}', 'DeliveryController@details');
        Route::get('/deliveries/{id}', 'DeliveryController@index');
        /*************************************
         *           End Order Route        *
         ************************************/
        /*************************************
         *           Reports Route           *
         ************************************/
        Route::get('/report', 'ReportsController@index');
        Route::post('/report', 'ReportsController@search');
        /*************************************
         *           End Reports Route        *
         ************************************/
        /*************************************
         *           Stocks Route           *
         ************************************/
        Route::get('/stock', 'StockController@index');
        Route::get('/stock/all', 'StockController@all');
        /*************************************
         *           End Stocks Route        *
         ************************************/

    });

    /*
    |--------------------------------------------------------------------------
    | End Authentication
    |--------------------------------------------------------------------------
    |
    */

});


