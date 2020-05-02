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


Route::get('/', 'MainController@index')->name('main');

Route::group(['prefix' => '{locale}/admin', 'namespace' => 'Admin', 'middleware'=>['auth','localize']], function () {
    Route::get('/', 'MainController@index')->name('admin.main.index');
    Route::resource('/reason', 'ReasonController', ['as' => 'admin']);
    Route::resource('/student', 'StudentController', ['as' => 'admin']);
    Route::resource('/transaction', 'TransactionController', ['as' => 'admin']);

});


Route::get('/blank', function () {
    \Illuminate\Support\Facades\Log::critical("message to slack FROm Laravel");
    return view('errors.not-allowed');
});



Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    //Artisan::call('backup:clean');
    return "Кэш очищен.";
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

