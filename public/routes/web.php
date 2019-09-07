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

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

//
//Route::get('/user', function () {
//    return 'user';
//});
//
//Route::get('/group', function () {
//    return 'group';
//});
//
//Route::get('/responsibility', function () {
//    return 'responsibility';
//});
//
//Route::get('/reason', function () {
//    return 'reason';
//});
//
//Route::get('/flow', function () {
//    return 'flow';
//});

