<?php

namespace App\Services;

use App\Services\Repositories\CategoryCacheRepository;
use App\Services\Repositories\CategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CategoriesService
 * @package App\Services
 */
class CategoriesService
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var CategoryCacheRepository
     */
    private $categoryCacheRepository;

    /**
     * CategoriesService constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryCacheRepository $categoryCacheRepository
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryCacheRepository $categoryCacheRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryCacheRepository = $categoryCacheRepository;
    }


    /**
     * @param array|null $options
     * @return Category[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->categoryRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function allPaginated(array $options = null)
    {
        return $this->categoryRepository->paginated($options);
    }

    public function getCategoriesList(array $options = null)
    {
        return $this->categoryCacheRepository->getList($options);
    }

    /**
     * @param array $data
     * @return Category
     */
    public function createCategory(array $data)
    {
        return $this->categoryRepository->createFromArray($data);
    }

    /**
     * @param Category $category
     * @param array $data
     * @return Category
     */
    public function updateCategory(Category $category, array $data)
    {
        return $this->categoryRepository->updateFromArray($category, $data);
    }

    /**
     * @param Category $category
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCategory(Category $category, array $options = null)
    {
        return $this->categoryRepository->delete($category);
    }

    /**
     * Очистка кэша
     */
    public function clearCache()
    {
        $this->categoryCacheRepository->clear();
    }
}
