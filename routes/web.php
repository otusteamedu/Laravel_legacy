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
    return view('site/index');
});

Route::get('/about', function () {
    return view('site/about');
});

Route::get('/user', function () {
    return view('site/user');
});

Route::get('/signUp', function () {
    return view('site/signUp');
});

Route::post('/signUp', function () {
    return view('site/pageInDevelopment');
});
