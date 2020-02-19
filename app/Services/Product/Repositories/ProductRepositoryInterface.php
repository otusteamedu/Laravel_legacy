<?php


namespace App\Services\Product\Repositories;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Product;

    public function updateFromArray(Product $category, array $data);

    public function destroy(int $id);
}
