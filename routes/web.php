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

Route::get('/', 'WelcomeController@main')->name('main');
Route::get('/home', 'WelcomeController@home')->name('home');
Route::get('/registration', 'WelcomeController@registration')->name('registration');
Route::get('/users', 'WelcomeController@users')->name('users');
