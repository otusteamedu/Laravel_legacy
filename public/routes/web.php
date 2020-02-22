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
Route::get('/add', 'BusScheduleController@add');
Route::match(['get', 'post'], '/', 'IndexController@show');
Route::match(['get', 'post'], '/newroute', 'BusScheduleController@store');
Route::get('/', 'IndexController@index');
Route::get('/schedule', 'BusScheduleController@index');
Route::get('/regions', 'RegionsController@index');
Route::get('/buses', 'BusController@index');
Route::get('/formcheck', 'BusController@formcheck');
Route::match(['get', 'post'], '/check', 'BusController@check');



