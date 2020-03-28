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
Auth::routes();

Route::get('/', function () {
    return view('statics.index');
})->name('index');

Route::get('/about', function () {
    return view('statics.about');
})->name('about');

Route::get('/home', 'OperationsController@index')->name('home');
Route::resource('operation', 'OperationsController')->except(['show', 'destroy']);
Route::get('operation/{id}/destroy', 'OperationsController@destroy')->name('operation.destroy');;
Route::get('operation/period', 'OperationsController@setPeriod')->name('operation.setPeriod');;



