<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function find(int $id)
    {
        return Category::find($id);
    }

    public function search(array $filters = [])
    {
        $query = Category::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
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

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }
}
