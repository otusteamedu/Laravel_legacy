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

Route::get('/katalog', function () {
    return view('pages/katalog');
});

Route::name('cms.')->group(function () {
    Route::prefix('')->group(function () {
        Route::resources([
            'users' => 'CMS\Users\UsersController',
        ], [
            'except' => [
            ],
        ]);
    });
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/', 'PagesController@index')->name('index');

Route::get('/profile', 'PagesController@profile',['updated'=>false])->name('profile')->middleware('auth');

// пришлось прописать полный путь, иначе, если прописать только UsersController@updateProfile, то
// выдаёт ошибку \App\Http\Controllers\UsersController.php not found
Route::patch('/profile/{user}', '\App\Http\Controllers\CMS\Users\UsersController@updateProfile')->name('update.profile')->middleware('auth');

