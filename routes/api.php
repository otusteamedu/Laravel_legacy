<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
    'middleware' => ['auth:api'],
], function() {
    Route::apiResource('/adverts', 'Adverts\AdvertsController');

});


Route::post('/register', 'Api\Auth\AuthController@register');
Route::post('/login', 'Api\Auth\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'Api\Auth\AuthController@logout');
});

