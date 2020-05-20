<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\TaskComment::class, function (Faker $faker) {
    $project = \App\Models\Project::all()->random();
    return [
        'task_id' => $project->tasks->random()->id,
        'user_id' => $project->users->random()->id,
        'text'    => $faker->text,
    ];
});
