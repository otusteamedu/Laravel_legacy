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


//Route::get('/countries', 'Cms\Countries\CountriesIndexController')->name('cms.countries.index');
//Route::get('/countries/create', 'Cms\CountriesController@create')->name('cms.countries.create');
//Route::get('/countries/{country}', 'Cms\CountriesController@show')->name('cms.countries.show');

//Route::middleware(['shareCommonData'])->group(function () {
//
//});

Route::name('cms.')->group(function () {
    Route::prefix('{locale}/cms')->middleware([
        'auth',
        'shareCommonData:admin',
        'localize',
    ])->group(function () {
        Route::resources([
            'countries' => 'Cms\Countries\CountriesController',
            'cities' => 'Cms\Cities\CitiesController',
            'users' => 'Cms\Users\UsersController',
        ]);
    });
});
Route::view('/home', 'home')
    ->name('home')
    ->middleware([
        'localize',
    ]);
Route::view('/', 'home');
Route::auth();

Route::get('/jobs', 'JobsController@index')->name('jobs.index');
Route::get('/jobs/failed', 'JobsController@failed')->name('jobs.failed');

Route::get('/home', 'HomeController@index');