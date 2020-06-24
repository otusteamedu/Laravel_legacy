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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::get('/', 'Api\Cms\Filters\FiltersController@index');
Route::get('/filters', 'Api\Cms\Filters\FiltersController@index');
Route::get('/filters/{filter}', 'Api\Cms\Filters\FiltersController@show');*/


/*Route::get('/', function (){
    return response()->json(['OK']);
});*/


Route::middleware('auth:api')->group(function () {
    Route::apiResource('filters', 'Api\Cms\Filters\FiltersController', [
        'expect' => [
            'destroy',
        ],
    ]);
    Route::get('/user', function (){
       return response()->json(Auth::user());
    });
});
