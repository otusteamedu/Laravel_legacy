<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Instructor;
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

$factory->define(Instructor::class, function (Faker $faker, $data) {

    $name = $faker->sentence(rand(5, 10), true);
    $data = [
        'instructor_id'   =>  $data['instructor_id'],
        'name' => isset($data['name']) ? $data['name']:$name,
        'description' => $faker->name,
        'link' => $faker->url,
    ];

    return $data;
});
