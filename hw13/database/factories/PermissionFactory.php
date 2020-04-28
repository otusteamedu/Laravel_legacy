<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Permission;
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

$factory->define(Permission::class, function (Faker $faker, $data) {

    $name = $faker->sentence(rand(5, 10), true);
    $route = $faker->sentence(rand(5, 10), true);
    $data = [
        'id'   =>  $data['id'],
        'name' => isset($data['name']) ? $data['name']:$name,
        'route' => isset($data['route']) ? $data['route'] : $route,
    ];

    return $data;


});
