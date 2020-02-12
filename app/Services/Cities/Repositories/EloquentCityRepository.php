<?php

namespace App\Services\Cities\Repositories;

use App\Models\City;

/**
 * Class EloquentCityRepository
 * @package App\Services\Cities\Repositories
 */
class EloquentCityRepository implements CityRepositoryInterface
{

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return City::find($id);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {
        return City::paginate();
    }

    /**
     * @param array $data
     * @return City
     */
    public function createFromArray(array $data): City
    {
        $city = new City();
        $city->create($data);
        return $city;
    }

    /**
     * @param City $city
     * @param array $data
     * @return City|mixed
     */
    public function updateFromArray(City $city, array $data)
    {
        $city->update($data);
        return $city;
    }

    /**
     * @param City $city
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(City $city)
    {
        $result = $city->delete();
        return $result;
    }
}