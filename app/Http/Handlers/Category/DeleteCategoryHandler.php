<?php

namespace App\Http\Handlers\Category;

use App\Models\Catalog\Category;

class DeleteCategoryHandler{

    public function handle(Category $category){
        $category->delete();
    }
}