<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\Divisions\DivisionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cms', 'Cms\CmsController@index');

Route::resources([
    'towns' => 'Cms\Towns\TownsController',
    'divisions' => 'Cms\Divisions\DivisionsController',
]);

//Route::get('/home', function () {
//    return view('/home/home');
//});
//
//Route::get('/advert', function () {
//    return view('/advert/advert');
//});
//
//Route::get('/auth', function () {
//    return view('/auth/register');
//});

//Route::get('/cms', function () {
//    return view('/cms/admin');
//});



