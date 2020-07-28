<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    $active = $faker->boolean;

    return [
        'email' => $faker->unique()->safeEmail,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'birthday' => $faker->date('Y-m-d'),
        'email_verified_at' => $active ? $faker->date('Y-m-d H:i:s') : null,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'status' => $active ? User::STATUS_ACTIVE : User::STATUS_UNACTIVE,
        'remember_token' => null,
        'role_id' => 3,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
