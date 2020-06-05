<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Year::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $year = $faker->unique()->year;
    return [
        //
        "name"=>$year,
        "slug"=>$year,
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
