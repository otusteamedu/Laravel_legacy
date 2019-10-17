<?php

namespace App\Services\Categories;

use App\Models\Category;

use App\Services\Categories\Repositories\CategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService {

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function findCategory(int $id) {
        return $this->categoryRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCategories(): LengthAwarePaginator {
        return $this->categoryRepository->search();
    }

    /**
     * @param array $data
     * @return Category
     */
    public function storeCategory(array $data): Category {
        return $this->categoryRepository->createFromArray($data);
    }

    /**
     * @param Category $category
     * @param array $data
     */
    public function updateCategory(Category $category, array $data) {
        $this->categoryRepository->updateFromArray($category, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyCategories(array $ids) {
       $this->categoryRepository->destroy($ids);
    }
}
