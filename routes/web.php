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
    return view('plain.sale');
});

Route::get('/user', function () {
    return view('plain.user');
});

Route::get('/registration', function () {
    return view('plain.registration');
});

Route::get('/offer', function () {
    return view('plain.offer');
});
