<?php


namespace Tests\Generators;


use App\Models\Country;

class CountryGenerator
{
    public static function createRussia(array $data = [])
    {
        return self::createCountry(array_merge($data, [
            'name' => 'Russia',
            'continent_name' => 'Europe',
        ]));
    }

    public static function createCountry (array $data = [])
    {
        return factory(Country::class)->create($data);
    }

}
