<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Category;

    public function updateFromArray(Category $category, array $data);

}
