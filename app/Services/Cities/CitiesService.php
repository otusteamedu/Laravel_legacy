<?php


namespace App\Services\Cities;

use App\Models\City;
use App\Services\Cities\Handlers\CreateCityHandler;
use App\Services\Cities\Repositories\CityRepositoryInterface;

class CitiesService
{
    private $cityRepository;
    private $createCityHandler;

    public function __construct(
        CreateCityHandler $createCityHandler,
        CityRepositoryInterface $cityRepository
    )
    {
        $this->createCityHandler = $createCityHandler;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param array $data
     * @return City
     */
    public function storeCity(array $data): City
    {
        return $this->createCityHandler->handle($data);
    }

    public function updateCity(City $city, array $data): City
    {
        return $this->cityRepository->updateFromArray($city, $data);
    }

}
