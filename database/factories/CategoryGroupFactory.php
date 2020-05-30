<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryGroup;
use Faker\Generator as Faker;

$factory->define(CategoryGroup::class, function (Faker $faker) {
    $name = $faker->text(50);
    return [
        'name' => $name,
        'position' => rand(0, 1000000)
    ];
});
