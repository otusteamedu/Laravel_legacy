<?php

namespace App\Http\Handlers\Category;

use App\Models\Catalog\Category;

class UpdateCategoryHandler{

    public function handle(Category $category, array $data){
        $category->update($data);
    }
}