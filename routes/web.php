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


Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){//, 'middleware'=>'auth'
//    Route::get('/','DashboardController@dashboard')->name('admin.index');

    //Route::get('/reasons/create/{group?}','ReasonsController@create')->where('group', '[0-9]+')->name('admin.reasons.create.group');
    Route::resource('/reason','ReasonController',['as'=>'admin']);

});

Route::get('/', function () {
    return view('layouts.page_main');
});

Route::get('/auth', function () {
    return view('layouts.page_auth');
});

Route::get('/blank', function () {
    return view('layouts.page_blank');
});

Route::get('/personal', function () {
    return view('layouts.page_personal');
});


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    //Artisan::call('backup:clean');
    return "Кэш очищен.";
});