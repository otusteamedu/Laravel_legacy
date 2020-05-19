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

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/exercise', function () {
    return view('pages.exercise');
});

Route::get('/complex', function () {
    return view('pages.complex');
});

Route::get('/register', function () {
    return view('pages.register');
});