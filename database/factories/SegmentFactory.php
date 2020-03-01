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
    $segments = [
        'Рекламная кампания Директ',
        'Рекламная кампания Адвордс',
        'Рекламная кампания Партнерские сети',
        'Рекламная кампания Оффлайн',
    ];
    shuffle($segments);
    $segment = array_shift($segments);
    return [
        'name' => $segment,
        'condition' => $faker->text,
        'created_at' => now(),
    ];
});
