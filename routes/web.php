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

use App\Http\Controllers\FileController;

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

Route::name('csm.')->group(function () {
    Route::prefix('cms')->group(function () {
        Route::resources([
            'projects' => 'Cms\Projects\ProjectsController',
            'tasks' => 'Cms\Tasks\TasksController',
        ]);


    });
});

Route::get('/news', 'NewsController@getAll');
Route::get('/news/{id}', 'NewsController@getId');

Route::get('/news/clear', 'NewsController@clearCache');

Route::get('/test', 'Subscriptions\MainController@index');
Route::match(['get', 'post'], '/test/write', 'Subscriptions\MainController@write')->name('write');

Route::get('/log', function () {
    Log::info('test');
    echo "ok";
});

Route::get('/file', [FileController::class, 'index']);
Route::post('/file', [FileController::class, 'store'])->name('store');

