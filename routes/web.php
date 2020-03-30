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
    return view('main.home.index');
});

Route::get('/about/', function () {
    return view('main.about.index');
});

Route::get('/prices', function () {
    return view('main.prices.index');
});

Route::get('/contacts', function () {
    return view('main.contacts.index');
});

Route::get('/personal', function () {
    return view('main.personal.index');
});

//Route::get('/registration', function () {
//    return view('main.personal.registration');
//});
//Route::get('/registration', 'Auth\RegisterController@index');
Route::group(['middleware' => ['auth']], function()
{
    Route::get('planner', 'PlannerController@index');
    Route::get('planner/gallery', 'PlannerController@gallery');

});
//Route::get('/planner', 'PlannerController@index');
//Route::get('/planner/gallery', 'PlannerController@gallery');

Route::Auth();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

