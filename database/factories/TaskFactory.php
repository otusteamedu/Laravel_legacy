<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'project_id' => rand(1, 15),
        'name' => $faker->text(rand(5, 15)),
        'description' => $faker->text,
        'user_id' => rand(1, 5)
    ];
});
