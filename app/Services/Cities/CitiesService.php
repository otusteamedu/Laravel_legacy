<?php
/**
 * Description of CitiesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities;


use App\Models\City;
use App\Services\Cities\Repositories\CityRepositoryInterface;
use App\Services\Cities\Repositories\EloquentCityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CitiesService
{

    /** @var EloquentCityRepository */
    private $cityRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository
    )
    {
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
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->cityRepository->getBy();
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator
    {
        return $this->cityRepository->search([]);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchCountriesWithCities(): LengthAwarePaginator
    {
        return $this->cityRepository->search([]);
    }

    /**
     * @param array $data
     * @return City
     */
    public function storeCity(array $data): City
    {
        return $this->cityRepository->createFromArray($data);
    }

    /**
     * @param City $country
     * @param array $data
     * @return City
     */
    public function updateCity(City $country, array $data): City
    {
        return $this->cityRepository->updateFromArray($country, $data);
    }
}