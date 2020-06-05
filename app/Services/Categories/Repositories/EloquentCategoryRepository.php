<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{

    public function search(array $filters = [])
    {
        return Category::paginate();
    }

    public function find(int $id)
    {
        return Category::find($id);
    }

    public function getProductsByCategoryGroup(int $categoryGroup)
    {
        return Category::where('group', $categoryGroup)
            /* TODO get from category_product  ->categoryProduct */
            ->get();
    }

    public function createFromArray(array $data): Category
    {
        $category = new Category();
        $category->create($data);
        return $category;
    }

    public function updateFromArray(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

}
