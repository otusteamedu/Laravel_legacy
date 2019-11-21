<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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

$factory->define(User::class, function (Faker $faker, $data) {

    // $name = isset($data['name']) ? $data['name']:$faker->name;
    return [
        'name' => isset($data['name']) ? $data['name'] : null,
        'email' => isset($data['email']) ? $data['email'] : null,
        'password' => bcrypt('secret'),
        'api_token' => Str::random(60),
        // 'email_verified_at' => now(),
        // 'remember_token' => Str::random(10),
    ];
});
