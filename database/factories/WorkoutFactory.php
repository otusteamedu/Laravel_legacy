<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Workout;
use Faker\Generator as Faker;

$factory->define(Workout::class, function (Faker $faker) {
    $timestamp = time();
    return [
        'name' => 'My workout',
        // @todo Вынести список типовых дистанций в отдельный класс
        'distance' => $faker->randomElement([
            5000,
            10000,
            21000
        ]),
        'duration' => $faker->numberBetween(15 * 60, 3 * 60 * 60),
        'started_at' => $faker->dateTimeBetween('-1 week', 'now'),
        'notes' => $faker->realText()
    ];
});
