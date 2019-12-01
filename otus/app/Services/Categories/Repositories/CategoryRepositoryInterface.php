<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface {
    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Category;

    public function updateFromArray(Category $category, array $data):Category;
}
