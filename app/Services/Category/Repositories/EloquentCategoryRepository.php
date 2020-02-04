<?php


namespace App\Services\Category\Repositories;

use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Builder;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function find(int $id)
    {
        return CategoryProduct::find($id);
    }

    /** Поиск категорий с фильтром
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $query = CategoryProduct::query();
        $this->applyFilters($query, $filters);
        return $query->paginate();
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

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }

    public function destroy(int $id)
    {
        return CategoryProduct::destroy($id);
    }

    public function getAllCategory()
    {
        return CategoryProduct::all();
    }
}
