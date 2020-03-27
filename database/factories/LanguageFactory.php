<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Language;
use Faker\Generator as Faker;

$factory->define(Language::class, function (Faker $faker) {
    return [
        'name' => getUniqueLanguageName($faker),
        'code' => getUniqueLanguageCode($faker),
        'country_id' => null,
    ];
});

if (!function_exists('getUniqueLanguageName')) {
    function getUniqueLanguageName(Faker $faker)
    {
        $name = $faker->country;

        if (Language::where('name', $name)->count()) {
            return getUniqueLanguageName($faker);
        }

        return $name;
    }
}

if (!function_exists('getUniqueLanguageCode')) {
    function getUniqueLanguageCode(Faker $faker)
    {
        $code = $faker->languageCode;

        if (Language::where('code', $code)->count()) {
            return getUniqueLanguageCode($faker);
        }

        return $code;
    }
}


