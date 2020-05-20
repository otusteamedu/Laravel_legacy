<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\ProjectTask::class, function (Faker $faker) {
    $project = \App\Models\Project::all()->random();
    return [
        'title'       => $faker->title,
        'description' => $faker->text,
    ];
});
