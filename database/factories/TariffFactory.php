<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tariff;
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

$factory->define(Tariff::class, function (Faker $faker) {
    $tariffs = [
        'Партнерский',
        'Одно предложение',
        'Пять предложений',
        'Безлимитные предложения',
    ];
    shuffle($tariffs);
    $tariff = array_shift($tariffs);
    return [
        'name' => $tariff,
        'condition' => $faker->text,
        'created_at' => now(),
    ];
});
