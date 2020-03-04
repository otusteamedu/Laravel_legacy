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

Route::view('/', 'home.index')
    ->name('home');

//'/login'
Route::view('/login', 'cms.auth.login.index')
    ->name('cms.auth.login.index');

//'/registration'
Route::view('/registration', 'cms.auth.registration.index')
    ->name('cms.auth.registration.index');

//'/recipes/{recipe}'
Route::view('/recipes/{recipe}', 'cms.recipes.show')
    ->name('cms.recipes.show');

//'/authors/{author}'
Route::view('/authors/{author}', 'cms.authors.show')
    ->name('cms.authors.show');

//'/{author}/recipes/create'
Route::view('{author}/recipes/create', 'cms.authors.recipes.create')
    ->name('cms.author.recipes.create');

//'/{author}/recipes'
Route::view('/{author}/recipes', 'cms.authors.recipes.index')
    ->name('cms.author.recipes.index');

//'/{author}/recipes/favorites'
Route::view('/{author}/recipes/favorites', 'cms.authors.recipes.favorites.index')
    ->name('cms.author.recipes.favorites.index');

//'/ratings/authors'
Route::view('/ratings/authors', 'cms.ratings.authors.index')
    ->name('cms.ratings.authors');

//'/{author}/edit'
Route::view('/{author}/edit', 'cms.authors.edit')
    ->name('cms.authors.edit');

//'/{author}'
Route::view('/{author}', 'cms.authors.index')
    ->name('cms.author.index');



