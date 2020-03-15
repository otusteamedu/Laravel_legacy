<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User\UserStatistic;
use Faker\Generator as Faker;

$factory->define(
    UserStatistic::class,
    function (Faker $faker) {
        return [
            'involvement' => $faker->numberBetween(),
            'popularity' => $faker->numberBetween(),
        ];
    }
);
