<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Consultation;
use Faker\Generator as Faker;

$factory->define(Consultation::class, function (Faker $faker) {
    return [
        'limit' => rand(0, 1) ? rand(1, 100) : null,
        'approved' => $faker->boolean,
    ];
});
