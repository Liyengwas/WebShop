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

//Redirect Users to homepage
Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Add to cart route
Route::get('/add-product/{product}', 'CartController@addProduct')->name('cart.add')->middleware('auth');
//View products Cart
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
//Remove Products from the Cart
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
//Update products in Cart
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
//Checkout products in Cart
Route::get('/cart/checkout', 'CartController@checkOut')->name('cart.checkout')->middleware('auth');
