<?php
/**
 * Description of CountryGenerator.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace Tests\Generators;


use App\Models\Country;

class CountryGenerator
{

    public static function createRussia(array $data = []): Country
    {
        return self::createCountry(array_merge([
            'name' => 'Russia',
        ], $data));
    }

    public static function createUkraine(array $data = []): Country
    {
        return self::createCountry(array_merge([
            'name' => 'Ukraine',
        ], $data));
    }

    public static function createEuropeCountry(array $data = []): Country
    {
        return self::createCountry(array_merge([
            'continent_name' => 'Europe',
        ], $data));
    }


    public static function createLongNameData(int $length = 101): array
    {
        return self::createRussiaData([
            'name' => \Str::random($length),
        ]);
    }

    public static function createRussiaData(array $data = []): array
    {
        return array_merge([
            'name' => 'Russia',
            'continent_name' => 'Europe',
        ], $data);
    }

    public static function createCountry(array $data = []): Country
    {
        return factory(Country::class)->create($data);
    }

}
