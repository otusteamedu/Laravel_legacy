<?php


namespace App\Services\Categories;

use App\Models\Category;
use App\Services\Categories\Handlers\CreateCategoryHandler;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;


class CategoriesService
{
    private $categoryRepository;
    private $createCategoryHandler;

    public function __construct(
        CreateCategoryHandler $createCategoryHandler,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function storeCategory(array $data): Category
    {
        return $this->createCategoryHandler->handle($data);
    }

}
