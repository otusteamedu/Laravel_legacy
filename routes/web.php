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

Auth::routes();

Route::middleware('auth')->group(function() {

    Route::get('/settings', 'SettingsController@edit')->name('settings.edit');
    Route::post('/settings', 'SettingsController@update')->name('settings.update');

    Route::prefix('podcasts')->name('podcasts.')->group(function() {
        Route::get('/', 'PodcastController@index')->name('index');
        Route::get('/create', 'PodcastController@create')->name('create');
        Route::post('/store', 'PodcastController@store')->name('store');
        Route::get('/{podcast}/edit', 'PodcastController@edit')->name('edit');
        Route::patch('/{podcast}', 'PodcastController@update')->name('update');
        Route::delete('/{podcast}', 'PodcastController@destroy')->name('destroy');
    });
});

