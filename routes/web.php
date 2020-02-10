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
    $locale = request()->lang;
    App::setLocale($locale);
    return view('page_welcome.welcome', [
        'currLang' => $locale,
    ]);
});

Route::get('/usercab/', function () {
    $locale = request()->lang;
    App::setLocale($locale);
    return view('page_usercab.usercab', [
        'currLang' => $locale,
    ]);
});

Route::get('/about/', function () {
    $locale = request()->lang;
    App::setLocale($locale);
    return view('page_static_content.static_content', [
        'currLang' => $locale,
    ]);
});

Route::get('/registration/', function () {
    $locale = request()->lang;
    App::setLocale($locale);
    return view('page_registration.registration', [
        'currLang' => $locale,
    ]);
});
