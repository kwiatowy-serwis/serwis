<?php

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




Auth::routes();
Route::get('/', 'MainController@index');


Route::group(['middleware' => ['auth', 'admin']], function (){


    Route::get('/admin', function (){
      return view('admin.index');
    })->name('admin');

});


Route::get('/home', 'HomeController@index')->name('home');



Route::get('/order', 'OrderController@index')->name('order');

Route::get('/order/make', 'OrderController@makeOrder')->name('makeOrder');
Route::get('/order/form', 'OrderController@order')->name('orderForm');






