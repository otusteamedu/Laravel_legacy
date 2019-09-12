<?php
/**
 * Description of CountryRepository.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Countries\Repositories;


use App\Models\Country;

class CountryRepository
{

    public function find(int $id)
    {
        return Country::find($id);
    }

    public function search()
    {
        return Country::paginate();
    }

    public function createFromArray(array $data)
    {
        $country = new Country();
        $country->create($data);
        return $country;
    }

    public function updateFromArray(Country $country, array $data)
    {
        $country->update($data);
        return $country;
    }

}