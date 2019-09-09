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
    return view('web.static.home.index');
})->name('home');

Route::get('/contact', function () {
    return view('web.static.contact.index');
})->name('contact');

Route::get('/app', function () {
    return view('app.dashboard.index');
})->name('app_dashboard');

Route::get('/app/profile', function () {
    return view('app.user.index');
})->name('user_profile');
