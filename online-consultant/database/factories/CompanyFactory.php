<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'url' => $faker->unique()->domainName,
        'address' => [
            'country' => $faker->country,
            'city' => $faker->city,
            'postcode' => $faker->postcode,
            'street' => $faker->streetName,
            'building_number' => $faker->buildingNumber
        ]
    ];
});
