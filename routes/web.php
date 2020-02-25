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
    return view('welcome');
});
Route::match(['get', 'post'] ,'/home', function () {
    echo ('welcome');
});

Route::get('/news/{id}/{name}', function ($id, $name) {
    return view('welcome');
});

Route::get('/registration/source', function () {
    return view('registration.source');
});
Route::get('/registration', function () {
    return view('registration.index');
});

Route::get('/registration1/source', function () {
    return view('registration1.source');
});
Route::get('/registration1', function () {
    return view('registration1.index');
});

Route::get('/cover/source', function () {
    return view('cover.source');
});
Route::get('/cover', function () {
    return view('cover.index');
});

Route::get('/checkout/source', function () {
    return view('checkout.source');
});
Route::get('/checkout', function () {
    return view('checkout.index');
});
