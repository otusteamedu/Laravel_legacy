<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Task::class, function (Faker $faker, $params) {

    $title = $faker->sentence(rand(3, 8), true);
    $description = $faker->realText(rand(12, 25));
    $priority = rand(1, 5) > 1;
    $status = rand(1, 2) > 1;

    $createdAt = $faker->dateTimeBetween('-7 days', '-3 days');

    $data = [
        'user_id' => 1,
        'title' => $title,
        'description' => $description,
        'priority' => rand(1, 5),
        'status_id' => $params['status_id'],
        'do_date' => $faker->dateTimeBetween('-2 days', '+1 days'),
        'created_at' => $createdAt,
        'updated_at' => $createdAt,

    ];

    return $data;


});
