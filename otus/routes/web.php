<?php

Route::name('admin.')->group(function() {
        Route::resources([
            'authors' => 'Authors\AuthorsController',
            'users' => 'Users\UsersController',
            'categories' => 'Categories\CategoriesController',
            'handbooks' => 'Handbooks\HandbooksController',
            'selection-materials' => 'SelectionMaterials\SelectionMaterialsController',
        ]);
});
