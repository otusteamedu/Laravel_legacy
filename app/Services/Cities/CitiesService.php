<?php

namespace App\Services\Cities;


use App\Models\City;
use App\Services\Cities\Handlers\CreateCityHandler;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class CitiesService
 * @package App\Services\Cities
 */
class CitiesService
{

    /** @var CityRepositoryInterface */
    private $cityRepository;
    /** @var CreateCityHandler */
    private $createCityHandler;

    /**
     * CitiesService constructor.
     * @param CreateCityHandler $createCityHandler
     * @param CityRepositoryInterface $cityRepository
     */
    public function __construct(
        CreateCityHandler $createCityHandler,
        CityRepositoryInterface $cityRepository
    )
    {
        $this->createCityHandler = $createCityHandler;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param int $id
     * @return City|null
     */
    public function findCity(int $id)
    {
        return $this->cityRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCities(): LengthAwarePaginator
    {
        return $this->cityRepository->search();
    }

    /**
     * @param array $data
     * @return City
     */
    public function storeCity(array $data): City
    {
        $city = $this->createCityHandler->handle($data);

        return $city;
    }

    /**
     * @param City $city
     * @param array $data
     * @return City
     */
    public function updateCity(City $city, array $data): City
    {
        return $this->cityRepository->updateFromArray($city, $data);
    }

    /**
     * @param City $city
     * @return bool
     */
    public function deleteCity(City $city): bool
    {
        return $this->cityRepository->delete($city);
    }

}