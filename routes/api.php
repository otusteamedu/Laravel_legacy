<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::resource('test', 'TestController');

Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->group(function() {
    Route::name('user.')
        ->prefix('user')
        ->group(function () {
        Route::name('list')->get('list', 'UsersController@index');
        Route::name('getUser')->get('get-user/{id}', 'UsersController@getUser');
        Route::name('update')->match(['patch', 'put'], 'update/{user}', 'UsersController@update');
//        Route::name('store')->post('save', 'UsersController@store');
    });
});

Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->group(function() {
        Route::name('role.')
            ->prefix('role')
            ->group(function () {
                Route::name('list')->get('list', 'RolesController@getList');
            });
    });
