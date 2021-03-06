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


Route::resource('products', 'ProductsController');

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search')->name('search');

Route::get( 'cart/add/{product}', 'CartController@add' )->name('cart.add');
Route::get( 'cart/show', 'CartController@show' )->name('cart.show');
Route::get( 'cart/{product}', 'CartController@destroy' )->name('cart.destroy');
Route::patch( 'cart/{product}', 'CartController@update' )->name('cart.update');

Route::resource('orders', 'OrdersController');
Route::resource('comments', 'CommentsController');
Route::resource('reviews', 'ReviewsController');
