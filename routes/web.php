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
Route::get('/grammatika', 'GrammarController@getList')->name('grammList');
Route::get('/grammatika/{id}', 'GrammarController@getDeatail');


Route::name('admin.')->group(function () {
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/', function() {
            return view('admin.main');
        });
        Route::resource('grammar', 'Admin\GrammarController');
        Route::resource('orthography', 'Admin\OrthographyController');
        Route::resource('settings', 'Admin\SettingsController')->only(['index', 'store']);
    });
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cc', 'HomeController@cc')->name('cc');
