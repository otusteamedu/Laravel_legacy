<?php


namespace App\Services\Product\Repositories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Builder;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function find(int $id)
    {
        return Products::with('category')->find($id);
    }

    /** Поиск товаров с фильтром
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $query = Products::query();
        //получаем категорию товара
        $query->with('category')->get();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Products
    {
        $category = new Products();
        $category->create($data);
        return $category;
    }

    public function updateFromArray(Products $category, array $data)
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
        return Products::destroy($id);
    }
}
