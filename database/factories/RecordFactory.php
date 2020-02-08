<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, static function (Faker $faker) {
    return [
        'date_start' => $faker->unixTime(),
        'date_finish' => $faker->unixTime(),
        'price' => random_int(500, 2500),
    ];
});
