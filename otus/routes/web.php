<?php

Route::name('admin.')->group(function() {
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
        ]);
});
