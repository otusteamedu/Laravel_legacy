<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lead;
use Faker\Generator as Faker;

$factory->define(Lead::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'info' => [
            'user_agent' => $faker->userAgent,
            'ip' => $faker->ipv4
        ]
    ];
});
