<?php

namespace App\Services\Products\Repositories;

use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function search(array $filters = [])
    {
        return Product::paginate();
    }

    public function find(int $id)
    {
        return Product::find($id);
    }

    public function createFromArray(array $data): Product
    {
        $product = new Product();
        $product->create($data);
        return $product;
    }

    public function updateFromArray(Product $product, array $data)
    {
        $product->update($data);
        return $product;
    }

    /* TODO */
    public function connectProductsToGroup(int $categoryGroup, array $productsIds)
    {

    }

    /* TODO */
    public function disconnectProductsFromGroup(int $categoryGroup, array $productsIds)
    {

    }

}
