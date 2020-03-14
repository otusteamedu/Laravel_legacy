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
    return view('home.main');
})->name('main');
Route::get('/personal/', function () {
    return view('personal.user');
})->name('personal');
Route::get('/join/', function () {
    return view('auth.register');
})->name('register');
Route::post('/join/', function () {
    return 'Регистрация не реализована.<br><a href="/">Вернуться на главную</a>';
})->name('register');
Route::get('/news/', function () {
    return view('news.list');
})->name('news');


