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
    return view('plain.sale');
});

Route::get('/user', function () {
    return view('plain.user');
});

Route::get('/registration', function () {
    return view('plain.registration');
});

Route::get('/offer', function () {
    return view('plain.offer');
});

Route::name('cms.')->group(function () {
    Route::prefix('cms')->group(function () {
        Route::resources([ // resources позволяет разложить методы контроллеров по CRUD роутам
            'countries' => 'Cms\Countries\CountriesController',
            'cities' => 'Cms\Cities\CitiesController',
            'categories' => 'Cms\Categories\CategoriesController',
            'tariffs' => 'Cms\Tariffs\TariffsController',
            'segments' => 'Cms\Segments\SegmentsController',
            'users' => 'Cms\Users\UsersController',
            'projects' => 'Cms\Projects\ProjectsController',
            'offers' => 'Cms\Offers\OffersController',
        ], [
            'except' => 'destroy',
        ]);
    });
});
