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

$factory->define(\App\Models\User::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $username = $firstName.' '.$lastName;
    return [
        'firstname' => $firstName,
        'lastname' => $lastName,
        'display_name'=>$username,
        'username'=> $faker->unique()->safeEmail,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'level' => User::LEVEL_MODERATOR,
        'website'=>"None",
        'fb_url'=>"",
        'vk_url'=>"",
        'ok_url'=>"",
        'api_token'=>Str::random(60)
    ];
});
