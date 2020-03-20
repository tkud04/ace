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

Route::get('/', 'MainController@getIndex');
Route::get('shop', 'MainController@getShop');
Route::get('product', 'MainController@getProduct');
Route::get('cart', 'MainController@getCart');
Route::get('checkout', 'MainController@getCheckout');
Route::get('contact', 'MainController@getContact');
Route::get('search', 'MainController@getSearch');
Route::get('terms', 'MainController@getTerms');
Route::get('track', 'MainController@getTrack');
