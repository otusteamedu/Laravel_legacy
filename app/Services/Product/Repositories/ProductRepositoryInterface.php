<?php

namespace App\Services\Product\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function find(int $id): ?Product;
    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array;
}
