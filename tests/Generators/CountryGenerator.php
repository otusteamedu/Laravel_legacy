<?php

namespace Tests\Generators;

use App\Models\Country;

class CountryGenerator
{
    public static function createCountryRussia(array $data = []) {
        $data['name'] = 'Россия';
        $data['phone_code'] = '+7';

        return self::createCountry(array_merge($data, []));
    }

    public static function getCountryRussia() {
        $countryRussiaCollection = Country::where('phone_code', '+7')->get();

        if ($countryRussiaCollection->count() > 0) {
            return $countryRussiaCollection;
        }

        return null;
    }

    public static function createCountryUkraine(array $data = []) {
        $data['name'] = 'Україна';
        $data['phone_code'] = '+38';

        return self::createCountry(array_merge($data, []));
    }

    public static function getCountryUkraine() {
        $countryUkraineCollection = Country::where('phone_code', '+38')->get();

        if ($countryUkraineCollection->count() > 0) {
            return $countryUkraineCollection;
        }

        return null;
    }

    public static function createCountry(array $data = []) {
        return factory(Country::class)->create($data);
    }

    public static function generateCountryCreateData(): array
    {
        return factory(Country::class)->make()->getAttributes();
    }
}
