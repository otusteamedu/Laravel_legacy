<?php
/**
 * Description of EloquentCityRepository.phptory.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Cities\Repositories;


use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

class EloquentCityRepository implements CityRepositoryInterface
{

    public function find(int $id): ?City
    {
        return City::find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @return City[]|Collection
     */
    public function getBy(array $filters = [], array $with = [])
    {
        return City::with($with)->get();
    }

    /**
     * @param array $filters
     * @param array $with
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection
     */
    public function search(array $filters = [], array $with = [])
    {
        return City::with($with)->paginate();
    }

    public function createFromArray(array $data): City
    {
        $city = new City();
        return $city->create($data);
    }

    public function updateFromArray(City $city, array $data)
    {
        $city->update($data);
        return $city;
    }

}