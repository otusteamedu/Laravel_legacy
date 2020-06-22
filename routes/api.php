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
*/

Route::get('/users/{page?}/{perPage?}/{search?}', 'API\Users\UserController@getList');
Route::get('/user/{id}/{lang?}', 'API\Users\UserController@get');
Route::get('/order/{id}', 'API\Orders\OrderController@get');
Route::get('/products/{page?}/{perPage?}/{search?}', 'API\Products\ProductController@getList');
Route::get('/order_statuses', 'API\OrderStatuses\OrderStatusController@getAll');
Route::patch('/order', 'API\Orders\OrderController@patch');
