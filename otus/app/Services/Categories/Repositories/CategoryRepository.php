<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository {

    public function find(int $id) {
        return Category::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Category::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Category::destroy($ids);
    }

    public function createFromArray(array $data) {
        $category = new Category();
        $category->fill($data);
        $category->save();

        return $category;
    }

    public function updateFromArray(Category $category, array $data) {
        $category->update($data);
        return $category;
    }
}
