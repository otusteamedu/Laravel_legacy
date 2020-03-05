<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, static function (Faker $faker) {
    $dateStart = $faker->dateTimeBetween('-90 days');
    $dateFinish = $dateStart->modify('+2 hours');

    return [
        'date_start' => $dateStart->getTimestamp(),
        'date_finish' => $dateFinish->getTimestamp(),
        'price' => random_int(500, 2500),
    ];
});
