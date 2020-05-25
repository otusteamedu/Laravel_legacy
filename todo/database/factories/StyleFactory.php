<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Style;
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

$factory->define(Style::class, function (Faker $faker, $data) {

    $name = $faker->sentence(rand(5, 10), true);
    $data = [
        'style_id'   =>  $data['style_id'],
        'name' => isset($data['name']) ? $data['name']:$name,
    ];

    return $data;


});
