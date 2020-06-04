<?php

namespace App\Services\Categories;

use App\Models\Category;
use App\Services\Categories\Handlers\CreateCategoryHandler;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoriesService
{

    private $createCategoryHandler;

    /** @var CategoryRepositoryInterface */
    private $categoryRepository;

    public function __construct(
        CreateCategoryHandler $createCategoryHandler,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCategories(): LengthAwarePaginator
    {
        return $this->categoryRepository->search();
    }

    /**
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data): Category
    {
        return $this->createCategoryHandler->handle($data);
    }

    /**
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public function updateCategory(Category $category, array $data): Category
    {
        return $this->categoryRepository->updateFromArray($category, $data);
    }

}
