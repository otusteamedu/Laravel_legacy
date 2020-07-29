<?php

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
*/


Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
    'as' => 'api.',
    'middleware' => ['auth:api'],
], function() {
    Route::apiResource('projects', 'Projects\ProjectController');
    Route::apiResource('clients', 'Clients\ClientController');
    Route::get('/user', 'Clients\ClientController@current')->name('user');
});
