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

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('locale');


Route::get('/', function () {
    return view('statics.index');
})->name('index');

Route::get('/about', function () {
    return view('statics.about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'OperationsController@index')->name('home');
    Route::resource('operation', 'OperationsController')->except(['show']);
    Route::get('operation/period', 'OperationsController@setPeriod')->name('operation.period');

    Route::resource('reviews', 'ReviewsController')->except(['show']);
//    Route::get('admin/oauth', 'OAuthController@index')->name('admin.oauth');
});
