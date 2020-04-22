<?php


namespace Tests\Generators;


use App\Models\City;

/**
 * Class CityGenerator
 * @package Tests\Generators
 */

class CityGenerator
{
    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
        public function createCity (array $data = [])
    {
        return factory(City::class)->create($data);
    }
}
