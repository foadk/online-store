<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('home', 'PagesController@home');
Route::get('/', 'PagesController@home');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::resource('products', 'ProductController');
Route::resource('categories', 'CategoryController');
Route::resource('orders', 'OrderController');

Route::get('products/{id}/delete', 'ProductController@destroy');

Route::get('basket', 'OrderController@showActive');
Route::get('orders_products/{id}/delete', 'OrderController@removeProduct');
Route::post('order/finalize_order', 'OrderController@finalizeOrder');
Route::get('order/finalize', 'OrderController@showFinalize');
Route::post('order/finalize', 'OrderController@finalizePurchase');

Route::get('test', function() {
    return time();
});

