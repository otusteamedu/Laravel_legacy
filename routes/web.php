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


Auth::routes();

Route::get('/', 'HomeController@index')->name('index');

Route::get('/about/', 'HomeController@about')->name('about.index');

Route::get('admin', 'HomeController@admin')->name('admin.index')->middleware(['auth', 'can:admin-section-available']);

Route::name('admin.')->middleware(['auth', 'can:admin-section-available'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resources([
            'articles' => 'Web\Admin\Articles\ArticlesController',
            'countries' => 'Web\Admin\Countries\CountriesController',
            'events' => 'Web\Admin\Events\EventsController',
            'languages' => 'Web\Admin\Languages\LanguagesController',
            'news' => 'Web\Admin\News\NewsController',
            'roles' => 'Web\Admin\Roles\RolesController',
            'users' => 'Web\Admin\Users\UsersController',
        ]);
    });
});

Route::get('/auth/', function () {
    return view('auth.index');
});

Route::get('/news/', function () {
    return view('news.index');
});

Route::get('/personal/', 'HomeController@personal')->middleware(['auth'])->name('personal.index');
Route::get('/personal/{user}', 'Web\Users\UsersController@edit')->middleware(['auth'])->name('user.edit');
Route::put('/personal/{user}', 'Web\Users\UsersController@update')->middleware(['auth'])->name('user.update');
Route::post('/personal/{user}', 'Web\Users\UsersController@store')->middleware(['auth'])->name('user.store');

