<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\ConstructionType;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(ConstructionType::class, function (Faker $faker) {

    $name = $faker->unique()->word;
    $hard = $faker->numberBetween($min = 0, $max = 100);

    return [
        'name' => $name,
        'description' => $faker->unique()->paragraph,
        'code' => "{$name}_{$hard}",
        'created_account_id' => 1
    ];
});

