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
    return view('index');
});
Route::get('/arabskie-bukvy', 'OrthographyController@getList');
Route::get('/arabskie-bukvy/{id}', 'OrthographyController@getDeatail');
Route::get('/grammatika', 'GrammarController@getList');
Route::get('/grammatika/{id}', 'GrammarController@getDeatail');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('grammar', 'Admin\GrammarController');
    });
});

