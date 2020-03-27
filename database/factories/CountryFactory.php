<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' => getUniqueCountryName($faker),
        'phone_code' => getUniqueCountryPhoneCode($faker),
    ];
});

if (!function_exists('getUniqueCountryName')) {
    function getUniqueCountryName(Faker $faker)
    {
        $name = $faker->country;
        if (Country::where('name', $name)->count()) {
            return getUniqueCountryName($faker);
        }

        return $name;
    }
}

if (!function_exists('getUniqueCountryPhoneCode')) {
    function getUniqueCountryPhoneCode(Faker $faker)
    {
        $phoneCode = '+' . $faker->phoneNumber;

        if (Country::where('phone_code', $phoneCode)->count()) {
            return getUniqueCountryPhoneCode($faker);
        }

        return $phoneCode;
    }
}

