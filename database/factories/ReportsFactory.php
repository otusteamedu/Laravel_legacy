<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Report;
use Faker\Generator as Faker;

$factory->define(Report::class, function (Faker $faker) {

    $status = [
        'success',
        'error'
    ];

    $i = $faker->passthrough(mt_rand(0, 1));

    return [
        'project_id' => rand(1, 15),
        'status' => $status[$i]
    ];
});
