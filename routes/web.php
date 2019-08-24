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

Route::get('/plain/index', function () {
    return view('plain.index');
});

Route::get('/plain/includes', function () {
    return view('plain.includes');
});
Route::get('/plain/for', function () {
    return view('plain.for');
});

Route::get('/plain/foreach', function () {
    return view('plain.foreach');
});
