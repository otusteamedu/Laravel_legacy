<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Country;
use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'active' => $faker->numberBetween(0, 1),
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'country_id' => Country::get()->random()->id || factory(Country::class, 1),
        'region' => $faker->state,
        'locality' => $faker->city,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone' => $faker->unique()->phoneNumber,
        'password' => md5(rand()),
        'picture_id' => (Picture::all()->count() > 0) ? Picture::all()->random()->id : factory(Picture::class, 100),
        'api_token' => Str::random(60),
    ];
});

