<?php

namespace App\Services\Category;

use App\Services\Category\Handlers\CreateCategoryHandler;
use App\Services\Category\Repositories\EloquentCategoryRepository;

class CaregoryService
{
    /** @var CategoryRepositoryInterface */
    private $countryRepository;
    /** @var CreateCategoryHandler */
    private $createCountryHandler;

    public function __construct(
        CreateCategoryHandler $createCategoryHandler,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->countryRepository = $categoryRepository;
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
    public function storeCountry(array $data): Country
    {
        $country = $this->createCountryHandler->handle($data);

        // do some logic

        return $country;
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
