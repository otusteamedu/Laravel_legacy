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
    return view('layouts.page_main');
});

Route::get('/auth', function () {
    return view('layouts.page_auth');
});

Route::get('/blank', function () {
    return view('layouts.page_blank');
});

Route::get('/personal', function () {
    return view('layouts.page_personal');
});