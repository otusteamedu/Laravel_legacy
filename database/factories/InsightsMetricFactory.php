<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InsightsMetric;
use Faker\Generator as Faker;

$factory->define(InsightsMetric::class, function (Faker $faker) {
    return [
        'code' => random_int(0, 100),
        'complexity' => random_int(0, 100),
        'architecture' => random_int(0, 100),
        'style' => random_int(0, 100),
        'security_issues' => random_int(0, 100),
    ];
});
