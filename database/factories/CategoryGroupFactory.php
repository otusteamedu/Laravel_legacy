<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryGroup;
use Faker\Generator as Faker;

$factory->define(CategoryGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'position' => rand(0, 1000000)
    ];
});
