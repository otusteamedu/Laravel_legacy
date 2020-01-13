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
    // задаётся в config/shop.php
    $sources = config('shop.sources');

    // категория посетителей сайтов
    $types = config('shop.types');

    // оператор, который работает с данным пользоваетелем
    $operators = config('shop.operators');


    return [
        'level' => User::LEVEL_USER,
        'source'=>$faker->randomElement($sources),
        'date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'type'=>$faker->randomElement($types),
        'operator'=>$faker->randomElement($operators),
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'address' => $faker->city,
        'comments' => '',
        // Внимание! В будущем планирую отвязать эти данные от пользователя
        // и перенести в акаунт
        'password' => '123',
        'remember_token' => Str::random(10),
    ];
});
