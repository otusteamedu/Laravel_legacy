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
Route::name('crm.')->group(function () {
    Route::prefix('crm')->group(function () {
        Route::resources([
            'trucks' => 'Trucks\TrucksController',
            'clients' => 'Clients\ClientsController',
            'schedule' => 'Schedule\ScheduleController',
            'orders' => 'Orders\OrdersController',
            'stats' => 'Stats\StatsController'
        ]);
    });
});


Route::get('/add', 'BusScheduleController@add');
Route::match(['get', 'post'], '/', 'IndexController@show');
Route::match(['get', 'post'], '/newroute', 'BusScheduleController@store');
Route::get('/', 'IndexController@index');
Route::get('/crm', 'Crm\CrmController@index');
Route::get('/regions', 'RegionsController@index');
Route::get('/buses', 'BusesController@index');
Route::get('/formcheck', 'BusesController@formcheck');
Route::match(['get', 'post'], '/check', 'BusesController@check');

Auth::routes();

Route::get('/users', ['middleware' => ['auth'], 'uses'=>'Core@show']);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');



