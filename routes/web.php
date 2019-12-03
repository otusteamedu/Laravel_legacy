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

use Illuminate\Support\Facades\Route;

Route::get('/', 'Section\SectionController@main');

Route::get('/section/{slug}', 'Section\SectionController@section');

Route::get('/element/{slug}', 'Element\ElementController@index');
