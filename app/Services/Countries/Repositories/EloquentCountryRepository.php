<?php

namespace App\Services\Countries\Repositories;

use App\Models\Country;

/**
 * Class EloquentCountryRepository
 * @package App\Services\Countries\Repositories
 */
class EloquentCountryRepository implements CountryRepositoryInterface
{

    /**
     * @return mixed
     */
    public function getListCountries()
    {
        return Country::select('id', 'name')->orderBy('name', 'desc')->get()->toArray();
    }
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return Country::find($id);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = [])
    {
        return Country::paginate();
    }

    /**
     * @param array $data
     * @return Country
     */
    public function createFromArray(array $data): Country
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }

    /**
     * @param Country $country
     * @param array $data
     * @return Country|mixed
     */
    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

    /**
     * @param Country $country
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(Country $country)
    {
        $result = $country->delete();
        return $result;
    }
}