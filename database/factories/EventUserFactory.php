<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EventUser;
use App\Models\Event;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(EventUser::class, function (Faker $faker) {
    return [
        'user_id' => (User::all()->count() > 0) ? User::all()->random()->id : factory(User::class, 100),
        'event_id' => (Event::all()->count() > 0) ? Event::all()->random()->id : factory(Event::class, 100),
        'is_successful' => $faker->numberBetween(0, 1),
    ];
});
