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
Route::get('/arabskie-bukvy', 'OrthographyController@list')->name('opthList');
Route::get('/arabskie-bukvy/{id}', 'OrthographyController@detail')->name('opthDetail');
Route::get('/grammatika', 'GrammarController@list')->name('grammList');
Route::get('/grammatika/{id}', 'GrammarController@detail')->name('grammDetail');
Route::get('/home', 'HomeController@index');

Route::name('admin.')->group(function () {
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::get('/', function () {
            return view('admin.main');
        });
        Route::resources([
            'grammar' => 'Admin\GrammarController',
            'orthography' => 'Admin\OrthographyController',
            'tests' => 'Admin\TestsController',
            'words' => 'Admin\WordsController'
        ]);
        Route::resource('settings', 'Admin\SettingsController')->only(['index', 'store']);
    });
});


Route::prefix('cache')->group(function () {
    Route::get('/', 'CacheController@index');
    Route::get('/clear', 'CacheController@clear');
    Route::post('/clear_key', 'CacheController@clearKey');
    Route::get('/heating', 'CacheController@heating');
    Route::get('/clear_grammar_detail', 'CacheController@clearGrammarDetail');

});

Auth::routes();

