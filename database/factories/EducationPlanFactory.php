<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EducationPlan;
use Faker\Generator as Faker;

$factory->define(EducationPlan::class, function (Faker $faker) {
    return [
        'hours' => rand(10, 300),
    ];
});
