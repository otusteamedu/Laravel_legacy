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
        Route::resources([
            'countries' => 'Cms\Countries\CountriesController',
            'cities' => 'Cms\Cities\CitiesController',
        ], [
            'except' => [
                'destroy',
            ],
        ]);
    });
});
Route::view('/home', 'home')->name('home');
Route::view('/', 'welcome');
Route::auth();


//Route::get('/cities', 'CitiesListController');
