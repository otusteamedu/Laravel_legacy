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

Route::name('cms.')->group(function () {
    Route::prefix('cms')->group(function () {
        Route::any('/', function (){
            return view('cms.index');
        })->name('index');

        Route::name('currencies.')->group(function () {
            Route::prefix('currencies')->group(function() {
                Route::any('/',  'Cms\Currencies\CurrenciesController@index')->name('index');
                Route::post('/store',  'Cms\Currencies\CurrenciesController@store')->name('store');
                Route::post('/delete',  'Cms\Currencies\CurrenciesController@delete')->name('delete');
            });
        });

        Route::name('countries.')->group(function () {
            Route::prefix('countries')->group(function() {
                Route::any('/',  'Cms\Countries\CountriesController@index')->name('index');
                Route::post('/store',  'Cms\Countries\CountriesController@store')->name('store');
                Route::post('/delete',  'Cms\Countries\CountriesController@delete')->name('delete');
            });
        });
    });
});


Route::get('/', function () {
    return view('welcome');
});

Route::any('/{lang}', function ($lang){
    App::setLocale($lang);
    $organizations = App\Models\Organization::all();
    $organizations->load('country');
    $organizations->load('orgBranch');
    $organizations->load('orgType');
    $organizations->load('orgGroup');

    return view('index', ['page' => 'index', 'lang' => $lang, 'data' => $organizations]);
});

Route::any('/{lang}/profile', function ($lang){
    App::setLocale($lang);
    return view('profile', ['page' => 'profile']);
});

Route::any('/{lang}/register', function ($lang){
    App::setLocale($lang);
    return view('register', ['page' => 'register']);
});

