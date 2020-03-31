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

Route::get('login', 'LoginController@getLogin');
Route::get('register', 'LoginController@getRegister');
Route::post('login', 'LoginController@postLogin');
Route::post('register', 'LoginController@postRegister');

Route::get('forgot-password', 'LoginController@getForgotPassword');
Route::post('forgot-password', 'LoginController@postForgotPassword');
Route::get('reset', 'LoginController@getPasswordReset');
Route::post('reset', 'LoginController@postPasswordReset');

Route::get('signout', 'LoginController@getLogout');

Route::get('dashboard', 'MainController@getDashboard');
Route::get('profile', 'MainController@getProfile');
Route::post('profile', 'MainController@postProfile');

Route::post('add-review', 'MainController@postAddReview');

Route::get('add-to-cart', 'MainController@getAddToCart');
Route::get('remove-from-cart', 'MainController@getRemoveFromCart');

Route::get('payment/callback', 'PaymentController@getPaymentCallback');
Route::post('pay', 'PaymentController@postRedirectToGateway');
