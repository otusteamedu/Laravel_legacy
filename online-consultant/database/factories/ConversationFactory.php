<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Conversation;
use Faker\Generator as Faker;

$factory->define(Conversation::class, function (Faker $faker) {
    return [
        'text' => $faker->text,
        'info' => [
            'user_agent' => $faker->userAgent,
            'ip' => $faker->ipv4
        ]
    ];
});
