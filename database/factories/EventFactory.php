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
        'author_id' => factory(User::class, 1)->create()->first()->id,
        'country_id' => factory(Country::class, 1)->create()->first()->id,
        'region' => $faker->state,
        'locality' => $faker->city,
        'type_id' => factory(EventType::class, 1)->create()->first()->id,
        'long' => $faker->longitude,
        'lat' => $faker->latitude,
    ];
});
