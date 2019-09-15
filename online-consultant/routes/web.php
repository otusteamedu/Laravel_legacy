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

Route::name('web.')->group(function () {
    Route::get('/', function () {
        return view('web.static.home.index');
    })->name('home');

    Route::get('/contact', function () {
        return view('web.static.contact.index');
    })->name('contact');
});

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::get('/profile', function () {
            return view('admin.user.index');
        })->name('user.profile');
    });
});
