<?php

Route::name('admin.')->middleware('auth')->group(function() {
        Route::resources([
            'authors' => 'Authors\AuthorsController',
            'users' => 'Users\UsersController',
            'categories' => 'Categories\CategoriesController',
            'handbooks' => 'Handbooks\HandbooksController',
            'selection-materials' => 'SelectionMaterials\SelectionMaterialsController',
            'journals' => 'Journals\JournalsController',
            'materials' => 'Materials\MaterialsController',
            'favorites' => 'Favorites\FavoritesController',
            'reviews' => 'Reviews\ReviewsController',
            'compilations' => 'Compilations\CompilationsController',
        ]);
});


Route::auth();
Route::get('/home', 'HomeController@index')->name('home');
