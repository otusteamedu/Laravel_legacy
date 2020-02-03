<?php


namespace App\Services\Category\Repositories;

use App\Models\CategoryProduct;
use PhpParser\Builder;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function find(int $id)
    {
        return CategoryProduct::find($id);
    }

    public function search(array $filters = [])
    {
        $query = CategoryProduct::query();
        $this->applyFilters($query,$filters);
        return CategoryProduct::paginate();
    }

    public function createFromArray(array $data): CategoryProduct
    {
        $category = new CategoryProduct();
        $category->create($data);
        return $category;
    }

    public function updateFromArray(CategoryProduct $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    private  function applyFilters(Builder $builder, array $filters){
        if(isset($filters['name'])){
            $builder->where('name',$filters['name']);
        }
    }

}
