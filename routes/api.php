<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/* Version v1*/
Route::prefix('v1')->middleware([
    'auth:api'
])->group(function () {
    Route::apiResource('films', 'Api\Cms\Films\FilmsController', []);
});

Route::prefix('v1')->group(function () {
    Route::post('register', 'Api\Cms\Auth\RegisterController');
    Route::post('login', 'Api\Cms\Auth\LoginController');
    Route::post('logout', 'Api\Cms\Auth\LogoutController')->middleware('auth:api');
});
