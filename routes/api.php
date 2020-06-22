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

Route::get('/me/email', function() {
    return ['email' => auth()->user()->email];
})->middleware(['auth:api', 'scope:user.email'])->name('me.email');

Route::get('/me/name', function() {
    return ['name' => auth()->user()->name];
})->middleware(['auth:api', 'scope:user.name'])->name('me.name');
