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
    return view('front.index');
});

Route::get('/about', function () {
    return view('front.about');
});

Route::get('/contacts', function () {
    return view('front.contacts');
});

Route::get('/login', function () {
    return view('front.login');
});

Route::get('/cms', function () {
    return view('cms.main');
});

Route::name('csm.')->group(function (){
    Route::prefix('cms')->group(function (){
    Route::resources([
        'projects' => 'Cms\Projects\ProjectsController',
    ]);


    });
});
