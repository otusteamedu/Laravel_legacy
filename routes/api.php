<?php

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
    ->prefix('auth')
    ->group(function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::get('refresh', 'AuthController@refresh')->name('refresh');
        Route::get('user', 'AuthController@getUser')->name('auth.getUser');
    });

Route::name('admin.')
    ->prefix('admin')
    ->namespace('Admin')
    ->middleware('accept-admin-panel')
    ->group(function() {
    Route::name('user.')
        ->prefix('user')
        ->group(function () {
        Route::name('list')->get('list', 'UsersController@index');
        Route::name('getUser')->get('get-user/{id}', 'UsersController@getUser');
        Route::name('update')->match(['patch', 'put'], 'update/{user}', 'UsersController@update')
            ->middleware('can:update,user');
        Route::name('create')->post('create', 'UsersController@create')
            ->middleware('can:create,'.\App\Models\User::class);
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
