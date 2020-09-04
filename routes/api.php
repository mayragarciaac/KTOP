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
Route::post('login', 'API\UserController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('category_list2', 'CategoryListController@index_api');
    Route::post('category_info2/{Id}', 'CategoryListController@show_api');
    Route::post('create_product2', 'ProductosController@store_api');
    Route::post('create_product_form_info/{Id}', 'ProductosController@form_info');
    Route::post('show_product2/{Id}', 'ProductosController@show_api');
});
