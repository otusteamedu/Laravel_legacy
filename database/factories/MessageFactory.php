<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
*/

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 2),
        'content' => implode(' ',$faker->sentences(1)),
    ];
});
