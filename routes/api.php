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

Route::middleware('auth:api')->group(function () {
    Route::apiResource(
        'events',
        '\App\Http\Controllers\Api\Events\EventsController',
        []
    );
});

Route::get('personal/get-token', '\App\Http\Controllers\Api\HomeController@getToken')
    ->name('personal.token');
