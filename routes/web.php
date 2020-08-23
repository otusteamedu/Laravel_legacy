<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/cms', 'Cms\CmsController@index')->middleware('auth')->name('cms');
Route::redirect('/', '/ru/home');

Route::get('/cookie/set/{town_id}','CookieController@setCookie')->name('setTown');
Route::get('/cookie/get','CookieController@getCookie')->name('getTown');

Auth::routes();
Route::group([
    'middleware' => 'auth',
    'namespace' => 'Cms',
], function()
{
    Route::resources([
        'towns' => 'Towns\TownsController',
        'divisions' => 'Divisions\DivisionsController',
        'adverts'=>'Adverts\AdvertsController',
        'messages'=>'Messages\MessagesController'
    ]);
});

Route::prefix('{locale}/')
    ->middleware('home')
    ->group(function () {
        Route::resource('home', 'HomeController')->parameters(['home' => 'advert']);

        Route::get('/division/{division}', 'SearchController@division')->name('division');
        Route::get('/division/{division}/town/{town}', 'SearchController@division')->name('town');
       // Route::get('/search/division/{division}/town/{town}', 'SearchController@search');

    });



//Route::get('/log', function () {
//    Log::critical('Critical message Sent from Laravel to Slack');
//    return redirect(route('home.index'));
//})->middleware('cms');






