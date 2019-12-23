<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;

class NativeCountryRepository implements CountryRepositoryInterface
{

    public function find(int $id)
    {
    }

    public function search(array $filters = [])
    {
        throw new \LogicException('This method not implemented');
    }

    public function getCountriesByContinentName(string $continentName)
    {

    }

    public function createFromArray(array $data): Country
    {

    }

    public function updateFromArray(Country $country, array $data)
    {

    }

}