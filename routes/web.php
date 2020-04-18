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

Route::get('/home', 'HomeController@index')->name('home');

Route::name('cms.')->group(function () {
    Route::prefix('cms')->middleware([
        'auth',
    ])->group(function () {
        Route::any('/', function (){
            return view('cms.index');
        })->name('index');

        Route::name('currencies.')->group(function () {
            Route::prefix('currencies')->group(function() {
                Route::any('/',  'Cms\Currencies\CurrenciesController@index')->name('index');
                Route::post('/store',  'Cms\Currencies\CurrenciesController@store')->name('store');
                Route::post('/update',  'Cms\Currencies\CurrenciesController@update')->name('update');
                Route::post('/delete',  'Cms\Currencies\CurrenciesController@delete')->name('delete');
            });
        });

        Route::name('countries.')->group(function () {
            Route::prefix('countries')->group(function() {
                Route::any('/',  'Cms\Countries\CountriesController@index')->name('index');
                Route::post('/store',  'Cms\Countries\CountriesController@store')->name('store');
                Route::post('/update',  'Cms\Countries\CountriesController@update')->name('update');
                Route::post('/delete',  'Cms\Countries\CountriesController@delete')->name('delete');
            });
        });

        Route::name('users.')->group(function () {
            Route::prefix('users')->group(function() {
                Route::any('/',  'Cms\Users\UsersController@index')->name('index');
                Route::post('/store',  'Cms\Users\UsersController@store')->name('store');
                Route::post('/update',  'Cms\Users\UsersController@update')->name('update');
                Route::post('/delete',  'Cms\Users\UsersController@delete')->name('delete');
            });
        });
    });
});

Route::get('/', function () {
    return view('welcome');
})->middleware([
    'ShareCommonData'
]);

Route::name('dashboard.')->group(function () {
    Route::prefix('/{locale}/')->middleware([
        'ShareCommonData', 'auth',
    ])->group(function () {
        Route::any('/',  'Common\Dashboard\DashboardController@index')->name('index');
        Route::post('/store',  'Common\Dashboard\DashboardController@store')->name('store');
    });
});

