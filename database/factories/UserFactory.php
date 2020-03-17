<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\UserGroup;

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

$userGroups = UserGroup::get(['code', 'id'])->pluck('id', 'code')->toArray();

$factory->define(User::class, static function (Faker $faker) {
    return [
        'first_name' => $faker->firstNameFemale,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'phone_number' => $faker->unique()->e164PhoneNumber
    ];
});

$factory->state(User::class, 'master', [
    'group_id' => $userGroups['master']
]);

$factory->state(User::class, 'client', [
    'group_id' => $userGroups['client']
]);
