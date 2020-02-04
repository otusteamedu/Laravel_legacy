<?php


namespace App\Services\Product\Repositories;

use App\Models\Products;

interface ProductRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Products;

    public function updateFromArray(Products $category, array $data);

    public function destroy(int $id);
}
