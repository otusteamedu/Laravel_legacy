<?php

namespace App\Services\Countries\Repositories;


use App\Models\Country;

/**
 * Interface CountryRepositoryInterface
 * @package App\Services\Countries\Repositories
 */
interface CountryRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * @return mixed
     */
    public function getListCountries();

    /**
     * @param Country $country
     * @return mixed
     */
    public function delete(Country $country);

    /**
     * @param array $filters
     * @return mixed
     */
    public function search(array $filters = []);

    /**
     * @param array $data
     * @return Country
     */
    public function createFromArray(array $data): Country;

    /**
     * @param Country $country
     * @param array $data
     * @return mixed
     */
    public function updateFromArray(Country $country, array $data);
}