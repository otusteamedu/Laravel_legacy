<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Segment;
use Faker\Generator as Faker;

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

$factory->define(Segment::class, function (Faker $faker) {
    return [
        'name' => 'Сегмент ' . $faker->unique()->text(10),
        'condition' => $faker->text,
        'created_at' => now(),
    ];
});
