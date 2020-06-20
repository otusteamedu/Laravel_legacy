<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/cms', 'Cms\CmsController@index')->middleware('auth');
Route::redirect('/', '/ru/home');

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


Route::get('/log', function () {
    Log::critical('Critical message Sent from Laravel to Slack');
    return redirect(route('home.index'));
})->middleware('cms');

Route::get('/user/{user}', function ($userId) {

    $user = User::remember(120)->find($userId);

    dd($user);

//    $userCacheKey = User::getCacheKey($userId);
//    $userFromCache = Cache::get($userCacheKey);
//    if(!empty($userFromCache)) {
//        $user = $userFromCache;
//    } else {
//        $user = User::find($userId);
//        $userJson = $user;
//        Cache::put($userCacheKey, $userJson, 120);
//    }


//    $userCacheKey = User::getCacheKey($userId);
//    $user = Cache::remember($userCacheKey, 120, function() use($userId){
//        return User::find($userId);
//    });

});


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



