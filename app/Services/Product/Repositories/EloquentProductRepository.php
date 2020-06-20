<?php

namespace App\Services\Product\Repositories;

use App\Services\Product\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array
    {
        return Product::getPage($page, $perPage, $search);
    }
}
