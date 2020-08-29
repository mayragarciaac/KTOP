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

Route::resource('login','LoginController');
Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@index']);
//Front 1 Administracion

Route::group(['middleware' => 'auth_session'], function () {
    Route::get('create_product/{Id}', 'ProductosController@form_data');
    Route::get('show_product/{IdProducto}', 'ProductosController@show');
    Route::post('/save_productform', 'ProductosController@store');
    Route::get('logout', 'LoginController@logout');
    Route::get('category_list/{Id}', 'CategoryListController@show');
    Route::resource('category_list', 'CategoryListController');
});

//Front 2
Route::get('/', 'CategoryListController@front_users');
Route::get('/category_products/{Id}', 'CategoryListController@front_users_category_products');
Route::get('/products/{Id}', 'ProductosController@front_products');
Route::post('/create_reserva', 'ProductosController@store_reserva');
Route::get('/resultado_reserva/{Id}', 'ProductosController@show_reserva');

Route::get('booking_products/{Id}', 'ProductosController@booking');



