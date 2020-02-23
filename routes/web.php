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
    return view('index');
});

Route::get('/about/', function () {
    return view('about.index');
});

Route::get('/news/', function () {
    return view('news.index');
});

Route::get('/articles/', function () {
    return view('articles.index');
});

Route::get('/auth/', function () {
    return view('auth.index');
});

Route::get('/registration/', function () {
    return view('register.index');
});

Route::get('/personal/', function () {
    return view('personal.index');
});


