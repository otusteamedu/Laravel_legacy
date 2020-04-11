<?php
/**
 * Description of CountryGenerator.php
 */

namespace Tests\Generators;


use App\Models\Country;

class CountryGenerator
{

    public static function createRussia(array $data = [])
    {
        return self::createCountry(array_merge($data, [
            'name' => 'Россия',
            'name_eng' => 'Russia',
            'currency_id' => null,
        ]));
    }

    public static function createSerbia(array $data = [])
    {
        return self::createCountry(array_merge($data, [
            'name' => 'Сербия',
            'name_eng' => 'Serbia',
            'currency_id' => null,
        ]));
    }

    public static function createCountry(array $data = []): Country
    {
        return factory(Country::class)->create($data);
    }

}
