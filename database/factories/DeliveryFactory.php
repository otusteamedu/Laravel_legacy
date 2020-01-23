<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Delivery;
use Faker\Generator as Faker;

$factory->define(Delivery::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'country'=>$faker->country,
        'address'=>$faker->address,
        'city'=>$faker->city,
        'phone' => $faker->phoneNumber,
        'email'=>$faker->unique()->email,
    ];
});
