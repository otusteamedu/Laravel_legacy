<?php

namespace App\Services\Categories;

use App\Models\Category;

use App\Services\Categories\Repositories\CachedCategoryRepositoryInterface;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService {

    private $categoryRepository;
    private $cachedCategoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, CachedCategoryRepositoryInterface $cachedCategoryRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->cachedCategoryRepository = $cachedCategoryRepository;
    }

    public function findCategory(int $id): Category {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return LengthAwarePaginator
     */
    public function searchCategories(): LengthAwarePaginator {
        return $this->cachedCategoryRepository->search();
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
