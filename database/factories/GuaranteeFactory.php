<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Guarantee;
use Faker\Generator as Faker;

$factory->define(Guarantee::class, function (Faker $faker) {
    $guarantee = $faker->text(30);
    return [
        'name' => $guarantee
    ];
});
