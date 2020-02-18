<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\User;
use App\Models\Country;
use App\Models\EventType;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'is_solved' => $faker->numberBetween(0, 1),
        'description' => $faker->text(300),
        'author_id' => (User::all()->count() > 0) ? User::all()->random()->id : factory(User::class, 100),
        'country_id' => Country::get()->random()->id,
        'region' => $faker->state,
        'locality' => $faker->city,
        'type_id' => EventType::all()->random()->id,
        'long' => $faker->longitude,
        'lat' => $faker->latitude,
    ];
});
