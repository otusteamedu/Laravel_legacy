<?php

namespace App\Services\Category;

use App\Models\CategoryProduct;
use App\Services\Category\Handlers\CreateCategoryHandler;
use App\Services\Category\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryService
{
    /** @var CategoryRepositoryInterface */
    private $categoryRepository;
    /** @var CreateCategoryHandler */
    private $createCategoryHandler;

    public function __construct(
        CreateCategoryHandler $createCategoryHandler,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->categoryRepository = $categoryRepository;
    }

    /** Create Category
     * @param array $data
     * @return CategoryProduct
     */
    public function createCategory(array $data): CategoryProduct
    {
        return $this->createCategoryHandler->handle($data);
    }

    /**
     * @param int $id
     * @return CategoryProduct|null
     */
    public function findCategory(int $id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCategory(): LengthAwarePaginator
    {
        return $this->categoryRepository->search();
    }

    /**
     * @param array $data
     * @return CategoryProduct
     */
    public function storeCategory(array $data): CategoryProduct
    {
        $category = $this->createCategoryHandler->handle($data);

        return $category;
    }

    /**
     * @param CategoryProduct $country
     * @param array $data
     * @return CategoryProduct
     */
    public function updateCategory(CategoryProduct $category, array $data): CategoryProduct
    {
        return $this->categoryRepository->updateFromArray($category, $data);
    }

    public function destroyCategory($id): int
    {
        return $this->categoryRepository->destroy($id);
    }

    public function formatCategoryToArray($categories)
    {
        foreach ($categories as $category) {
            $response[$category->id] = $category->name;
        }

        return $response;
    }

    public function getAllCategory()
    {
        return $this->categoryRepository->getAllCategory();
    }
}
