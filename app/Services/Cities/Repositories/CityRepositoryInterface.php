<?php

namespace App\Services\Cities\Repositories;


use App\Models\City;

/**
 * Interface CityRepositoryInterface
 * @package App\Services\Cities\Repositories
 */
interface CityRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @param City $city
     * @return mixed
     */
    public function delete(City $city);

    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = []);

    /**
     * @param array $data
     * @return City
     */
    public function createFromArray(array $data): City;

    /**
     * @param City $city
     * @param array $data
     * @return mixed
     */
    public function updateFromArray(City $city, array $data);
}