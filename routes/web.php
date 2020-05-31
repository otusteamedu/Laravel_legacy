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

Route::group([
    'prefix' => 'cms',
    'middleware' => \App\Http\Middleware\Authenticate::class
], function () {
    Route::get('/', function () {
        return view('cms.index');
    });

    Route::group([
        'prefix' => 'blog'
    ], function() {
        /**
         * Articles
         */
        Route::get('articles', 'Cms\BlogArticleController@index')->name('cms.blog.articles');
        Route::get('article/create', 'Cms\BlogArticleController@create')->name('cms.blog.articl.create');
        Route::get('article/{article}/edit', 'Cms\BlogArticleController@edit')->name('cms.blog.article.edit');
        Route::post('article/{article}/edit', 'Cms\BlogArticleController@store')->name('cms.blog.article.store');

        /**
         * Sections
         */

        Route::get('sections', function () {
            return view('cms.blog.sections');
        })->name('cms.blog.sections');

        /**
         * Authors
         */
        Route::get('authors', 'Cms\BlogAuthorController@index')->name('cms.blog.authors');
        Route::get('author/create', 'Cms\BlogAuthorController@create')->name('cms.blog.author.create');
        Route::post('author/create', 'Cms\BlogAuthorController@store')->name('cms.blog.author.create');

        Route::get('author/{author}/edit', 'Cms\BlogAuthorController@edit')->name('cms.blog.author.edit');
        Route::post('author/{author}/edit', 'Cms\BlogAuthorController@store')->name('cms.blog.author.store');

        Route::get('author/{author}/delete', 'Cms\BlogAuthorController@delete')->name('cms.blog.author.delete');
        Route::post('author/{author}/delete', 'Cms\BlogAuthorController@delete')->name('cms.blog.author.delete');
    });

    Route::group([
        'prefix' => 'config'
    ], function() {
        Route::get('users', function() {
            return view('cms.config.users');
        })->name('config.users');
    });

    Route::group([
        'prefix' => 'files'
    ], function() {
        Route::get('/', function() {
            return view('cms.files');
        })->name('files');
    });
});

Route::group([
    'prefix' => \App\Services\LanguageResolver::getLanguageFromRequst(),
    'middleware' => \App\Http\Middleware\LocaleMiddleware::class
], function(){
    Route::get('/', function () {
        return view('main.home.index');
    })->name('home');

    Route::get('/about/', function () {
        return view('main.about.index');
    })->name('about');

    Route::get('/prices/', function () {
        return view('main.prices.index');
    })->name('prices');

    Route::get('/contacts/', function () {
        return view('main.contacts.index');
    })->name('contacts');

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login');

    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

    Route::group([
        'prefix' => 'personal',
        'middleware' => \App\Http\Middleware\Authenticate::class
    ], function () {
        Route::get('/', function () {
            return view('main.personal.index');
        })->name('personal');

        Route::get('/logout', function () {
            return view('main.personal.index');
        })->name('logout');
    });
});

//Route::get('/personal', function () {
//    return view('main.personal.index');
//});
//
//Route::group(Array(
//    'middleware' => Array(
//        'auth',
//    )
//), function () {
//    // Админка
//    Route::group(Array(
//        'prefix' => 'cp',
//        'middleware' => Array(
//            'isAdmin',
//        )
//    ), function () {
//        Route::get('', 'ControlPanelController@index');
//    });
//
//    // Планнер
//    Route::group(Array(
//        'prefix' => 'planner',
//    ), function () {
//        Route::get('', 'PlannerController@index');
//        Route::get('gallery', 'PlannerController@gallery');
//        Route::get('my-proxy', 'PlannerController@myProxy');
//        Route::get('my-accounts', 'PlannerController@myAccounts');
//    });
//
//    // Блог
//    Route::group(Array(
//        'prefix' => 'blog',
//    ), function () {
//        Route::get('', 'BlogController@index');
//    });
//});
//
//Route::Auth();
//
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');
//
//Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
//Route::post('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//
////Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

