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

    public static function createRussia(array $data = [])
    {
        return self::createCountry(array_merge([
            'name' => 'Russia',
        ], $data));
    }

    public static function createUkraine(array $data = [])
    {
        return self::createCountry(array_merge([
            'name' => 'Ukraine',
        ], $data));
    }

    public static function createCountry(array $data = [])
    {
        return factory(Country::class)->create($data);
    }

}