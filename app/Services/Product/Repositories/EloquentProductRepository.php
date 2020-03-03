<?php


namespace App\Services\Product\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function find(int $id)
    {
        return Product::with('category')->find($id);
    }

    /** Поиск товаров с фильтром
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search(array $filters = [])
    {
        $query = Product::query();
        //получаем категорию товара
        $query->with('category')->get();
        $this->applyFilters($query, $filters);
        return $query->paginate();
    }

    public function createFromArray(array $data): Product
    {
        $category = new Product();
        $category->create($data);
        return $category;
    }

    public function updateFromArray(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    private function applyFilters(Builder $builder, array $filters)
    {
        if (isset($filters['name'])) {
            $builder->where('name', $filters['name']);
        }
    }

    public function destroy(int $id)
    {
        return Product::destroy($id);
    }
}
