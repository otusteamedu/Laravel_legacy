<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
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
    $imageUrls = [
        public_path() . '/images/user1.jpg',
        public_path() . '/images/user2.jpg',
        public_path() . '/images/user3.jpg',
        public_path() . '/images/user4.jpg',
        public_path() . '/images/user5.jpg',
        public_path() . '/images/user6.jpg',
        public_path() . '/images/user7.jpg',
        public_path() . '/images/user8.jpg',
        public_path() . '/images/user9.jpg',
        public_path() . '/images/user10.jpg',
    ];

    shuffle($imageUrls);
    $url = array_shift($imageUrls);

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password_hash' => $faker->md5,
        'photo' => $url
    ];
});
