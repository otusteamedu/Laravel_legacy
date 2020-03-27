<?php

namespace Tests\Generators;

use App\Models\Country;
use App\Models\Language;

class LanguageGenerator
{
    public static function createLanguageRussian(array $data = []) {
        $countryRussia = CountryGenerator::getCountryRussia();

        if (empty($countryRussia)) {
            $countryRussia = CountryGenerator::createCountryRussia();
        }

        $data['name'] = 'русский';
        $data['code'] = 'rus';
        $data['country_id'] = $countryRussia->get()->id;

        return self::createLanguage(array_merge($data, []));
    }

    public static function createLanguageUkrainian(array $data = []) {
        $countryUkraine= CountryGenerator::getCountryUkraine();

        if (empty($countryRussia)) {
            $countryUkraine = CountryGenerator::createCountryUkraine();
        }

        $data['name'] = 'українська';
        $data['code'] = '+38';
        $data['country_id'] = $countryUkraine->get()->id;

        return self::createLanguage(array_merge($data, []));
    }

    public static function createLanguage(array $data = []) {
        return factory(Language::class)->create($data);
    }

    public static function generateLanguageCreateData(): array
    {
        return factory(Language::class)->make()->getAttributes();
    }
}
