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

Route::any('/ru', function (){
    App::setLocale('ru');
    return view('index', ['page' => 'index']);
});
Route::any('/en', function (){
    App::setLocale('en');
    return view('index', ['page' => 'index']);
});

Route::any('/ru/profile', function (){
    App::setLocale('ru');
    return view('profile', ['page' => 'profile']);
});
Route::any('/en/profile', function (){
    App::setLocale('en');
    return view('profile', ['page' => 'profile']);
});

Route::any('/ru/register', function (){
    App::setLocale('ru');
    return view('register', ['page' => 'register']);
});
Route::any('/en/register', function (){
    App::setLocale('en');
    return view('register', ['page' => 'register']);
});
