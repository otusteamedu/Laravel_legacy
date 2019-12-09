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

Route::group(['as' => 'users.', 'prefix' => 'users'], function () {
    Route::get('/', 'UserController@showList')->name('list');

    Route::get('/my-page', 'UserController@showUserPage')
        ->name('user-page')
        ->middleware('auth');
});

Route::name('site.')->group(function () {
    Route::get('/', 'SiteController@index')->name('index');
    Route::get('/about', 'SiteController@showAbout')->name('about');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
