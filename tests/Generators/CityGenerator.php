<?php


namespace Tests\Generators;


use App\Models\City;

/**
 * Class CityGenerator
 * @package Tests\Generators
 */

class CityGenerator
{
    public static function createMoscow(array $data = [])
    {
        return self::createCity(array_merge($data, [
            'name' => 'Moscow',
            'country_id' => '1',
        ]));
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
        public static function createCity (array $data = [])
    {
        return factory(City::class)->create($data);
    }
}
