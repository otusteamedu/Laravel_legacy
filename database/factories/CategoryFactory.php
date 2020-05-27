<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use App\Models\CategoryGroup;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->text(50);
    return [
        'name' => $name,
        'group_id' => rand(1, CategoryGroup::count()),
        'position' => rand(0, 1000000)
    ];
});
