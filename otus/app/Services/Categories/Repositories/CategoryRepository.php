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
        $Category = new Category();
        $Category->fill($data);
        $Category->save();

        return $Category;
    }

    public function updateFromArray(Category $Category, array $data) {
        $Category->update($data);
        return $Category;
    }
}
