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
    return view('home');
})->name('home');

Route::get('/register/', function () {
    return view('register');
})->name('register');

Route::get('/about/', function () {
    return view('about');
})->name('about');

Route::get('/profile/', function () {
    return view('profile');
})->name('profile');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resources([
            'countries' => 'Admin\Countries\CountriesController',
            'cities' => 'Admin\Cities\CitiesController',
        ]);
    });
});