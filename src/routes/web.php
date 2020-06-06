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
    return view('home.landing');
});


Route::get('/home', function () {
    return view('home.index');
});
Route::get('/records', function () {
    return view('records.history');
});
Route::get('/staff', function () {
    return view('staff.index');
});
Route::get('/procedures', function () {
    return view('procedures.index');
});
Route::get('/statistic', function () {
    return view('statistic.index');
});
Route::get('/business', function () {
    return view('business.index');
});
Route::get('/feedback', function () {
    return view('feedback.index');
});
Route::get('/message', function () {
    return view('message.index');
});

Auth::routes();
