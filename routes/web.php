<?php

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

Route::get('/', function () {
    return view('main.index');
});

Route::get('/register', function () {
    return view('register.index');
});

Route::get('/user', function () {
    return view('user.index');
});

Route::get('/helps', function () {
    return view('helps.index');
});
Route::get('/php-info', function () {
    return view('phpInfo.index');
});

Route::get('/administrator', function () {
    return view('phpInfo.index');
});

Route::get('/administrator', 'admin\RolesController@index');

Route::post('/administrator', 'admin\RolesController@store');

//Route::resource('administratorOld', 'admin\AdminController');