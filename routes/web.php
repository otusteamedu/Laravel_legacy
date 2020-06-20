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
    'middleware' => Array(
        \App\Http\Middleware\Authenticate::class
    )
], function () {
    Route::get('/', function () {
        return view('cms.index');
    });

    Route::group([
        'prefix' => 'blog',
        'middleware' => Array(
            \App\Http\Middleware\IsAdmin::class
        )
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
});

Route::group([
    'prefix' => \App\Services\LanguageResolver::getLanguage(),
    'middleware' => \App\Http\Middleware\LocaleMiddleware::class
], function(){
    Route::get('/', function () {
        return view('main.home.index');
    })->name('home');

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

        /**
         * Proxy
         */
        Route::get('/proxy', 'ProxyController@index')->name('proxy');
        Route::get('/proxy/create', 'ProxyController@create')->name('proxy.create');
        Route::post('/proxy/create', 'ProxyController@store')->name('proxy.store');
        Route::get('/proxy/{proxy}/edit', 'ProxyController@edit')->name('proxy.edit');
        Route::get('/proxy/{proxy}/delete', 'ProxyController@delete')->name('proxy.delete');

        Route::get('/planner', 'PlannerController@index')->name('planner');

        Route::any('/logout', 'Auth\LoginController@logout')->name('logout');
    });
});

Route::any("/", function(){
    return Redirect::to(\App\Services\LanguageResolver::getLanguageUrl());
});
