<?php

namespace App\Services\Category;

use App\Models\CategoryProduct;
use App\Services\Category\Handlers\CreateCategoryHandler;
use App\Services\Category\Repositories\EloquentCategoryRepository;

class CaregoryService
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

    /**
     * @param array $data
     * @return CategoryProduct
     */
    public function createCategory(array $data): CategoryProduct
    {
        return $this->createCategoryHandler->handle($data);
    }

    /**
     * @param int $id
     * @return Country|null
     */
    public function findCountry(int $id)
    {
        return $this->countryRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCountries(): LengthAwarePaginator
    {
        return $this->countryRepository->search();
    }

    /**
     * @param array $data
     * @return Country
     */
    public function storeCategory(array $data): CategoryProduct
    {
        $category = $this->createCategoryHandler->handle($data);

        return $category;
    }

    /**
     * @param Country $country
     * @param array $data
     * @return Country
     */
    public function updateCountry(Country $country, array $data): Country
    {
        return $this->countryRepository->updateFromArray($country, $data);
    }
}
