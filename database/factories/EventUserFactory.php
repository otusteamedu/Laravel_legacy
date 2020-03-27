<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Faker\Generator as Faker;

$factory->define(EventUser::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class, 1),
        'event_id' => factory(Event::class, 1),
        'is_successful' => $faker->numberBetween(0, 1),
    ];
});
