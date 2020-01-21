<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
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

$factory->define(\App\Models\Item::class, function (Faker $faker) {
    $images = [
        '/img/cards/1.jpeg',
        '/img/cards/2.jpeg',
        '/img/cards/3.jpeg',
        '/img/cards/4.jpeg',
        '/img/cards/5.jpeg',
    ];
    return [
        'name' => $faker->text(20),
        'description' => $faker->sentence(6),
        'active' => true,
        'photo' => $faker->randomElement($images),
    ];
});
