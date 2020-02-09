<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User\User;
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
    $images = ['713ba73b309105aa086913ff82744c51.jpg', '48231555782cf5b212.jpg', 'b804f7881a3f9cfb05e3a32e0da83d49.jpg'];
    $item = random_int(0, 2);
    return [
        'name' => $faker->name,
        'icon' => $images[$item],
        //$faker->image('public/storage/images', 50, 50, null, false),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
