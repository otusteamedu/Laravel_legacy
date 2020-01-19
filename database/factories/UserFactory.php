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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'status' => $faker->numberBetween(0, 1),
        'group' => $faker->numberBetween(1, 3),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'static-password', [
    'password' => '12345678',
    'password_confirmation' => '12345678',
]);

$factory->state(User::class, 'active', [
    'status' => User::USER_STATUS_ACTIVE,
]);

$factory->state(User::class, 'banned', [
    'status' => User::USER_STATUS_BANNED,
]);

$factory->state(User::class, 'admin', [
    'group' => User::USER_GROUP_ADMIN,
]);

$factory->state(User::class, 'manager', [
    'group' => User::USER_GROUP_MANAGER,
]);

$factory->state(User::class, 'customer', [
    'group' => User::USER_GROUP_CUSTOMER,
]);