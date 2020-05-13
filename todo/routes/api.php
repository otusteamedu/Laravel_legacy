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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('tasks', 'Api\TasksController');
    Route::apiResource('styles', 'Api\StylesController');
    Route::apiResource('prices', 'Api\PricesController');
    Route::apiResource('instructors', 'Api\InstructorsController');
    Route::apiResource('schedule', 'Api\ScheduleController');
});

//Route::apiResource('tasks', 'Api\TasksController');