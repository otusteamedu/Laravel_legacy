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
    // перечень сайтов - источников лидов
    $sources = ['fruit-shop.ru', 'sweet-fruits.ru', 'juicy-fruits', 'crazy-banana.com'];
    // категория посетителей сайтов
    $types = ['лид','покупатель','конкурент'];

    return [
        'source'=>$faker->randomElement($sources),
        'date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'type'=>$faker->randomElement($types),
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,  
        'email_verified_at' => now(),
        'address' => $faker->address,
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //'remember_token' => Str::random(10),
    ];
});
