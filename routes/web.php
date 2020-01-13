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

Route::get('/', function () {
    return view('pages/homepage2');
});
Route::get('account', function () {
    return view('pages/account');
});
Route::get('login', function () {
    return view('pages/login');
});
Route::get('product', function () {
    return view('pages/product');
});
Route::get('cart', function () {
    return view('pages/cart');
});
Route::get('checkout', function () {
    return view('pages/checkout');
});
