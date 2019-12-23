<?php

use Illuminate\Http\Request;
use App\User;
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

//Route::prefix('apigrammar')->group(function () {
//Route::apiResource('grammar',  'Api\GrammarController');
//});
//
Route::middleware(['auth:api'])
    ->name('api.')
    ->group(function () {
    Route::apiResource('grammar', 'Api\GrammarController', [
        'except' => [
            'destroy',
        ],
    ]);
});
