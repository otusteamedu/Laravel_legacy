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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/me/email', 'UsersController@getEmail')->middleware('auth:api', 'scope:user.email');
Route::get('/me/name', 'UsersController@getName')->middleware('auth:api', 'scopes');

Route::resource('operations', 'Api\OperationController')->except(['create', 'edit'])->middleware('auth:api');

