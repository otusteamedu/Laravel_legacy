<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        "title" => $faker->unique()->company,
        "description" => $faker->text(70),
        "publish" => 1
    ];
});
