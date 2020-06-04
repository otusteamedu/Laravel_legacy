<?php

namespace App\Services\Products\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Product;

    public function updateFromArray(Product $product, array $data);

    public function connectProductsToGroup(int $categoryGroup, array $productsIds);

    public function disconnectProductsFromGroup(int $categoryGroup, array $productsIds);

}
