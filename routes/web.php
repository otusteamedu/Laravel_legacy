<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/cms', 'Cms\CmsController@index')->middleware('auth');
Route::redirect('/', '/home');

Auth::routes();
Route::group(['middleware' => 'auth'], function()
{
    Route::resources([
        'towns' => 'Cms\Towns\TownsController',
        'divisions' => 'Cms\Divisions\DivisionsController',
        'adverts'=>'Cms\Adverts\AdvertsController',
        'messages'=>'Cms\Messages\MessagesController'
    ]);
});

Route::prefix('{locale}/')
    ->middleware('home')
    ->group(function () {
        Route::resource('home', 'HomeController')->parameters(['home' => 'advert']);
    });

//Route::resource('home', 'HomeController')->parameters(['home' => 'advert'])->middleware('home');

Route::get('/log', function () {
    Log::critical('Critical message Sent from Laravel to Slack');
    return redirect(route('home.index'));
})->middleware('cms');





//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/advert', function () {
//    return view('/advert/advert');
//});
//
//Route::get('/auth', function () {
//    return view('/auth/register');
//});

//Route::get('/cms', function () {
//    return view('/cms/admin');
//});



