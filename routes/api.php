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
Route::namespace('Auth')
    ->middleware([
        'api'
    ])
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
});

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
        Route::name('create')->post('create', 'UsersController@create');
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
