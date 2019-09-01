<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $name = $faker->unique()->company;
    return [
        'name' => $name,
        'url' => Str::slug($name),
        'description' => $faker->text(500),
    ];
});
