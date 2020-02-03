<?php


namespace App\Services\Category\Repositories;

use App\Models\CategoryProduct;

interface CategoryRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): CategoryProduct;

    public function updateFromArray(CategoryProduct $country, array $data);
}
