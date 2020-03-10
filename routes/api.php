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

<<<<<<< HEAD

Route::resource('projects', 'Api\ProjectController')
    ->except('create', 'edit')
    ->middleware(['auth:api', 'scope:projects']);
=======
Route::resource('projects', 'Api\ProjectController')->except('create', 'edit')
    ->middleware('auth:api, scope:projects');
>>>>>>> 6fec2bb6808c3e01ed5b534b82a58e49b8f8c4a0
