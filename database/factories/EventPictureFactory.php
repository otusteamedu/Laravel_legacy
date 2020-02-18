<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\EventPicture;
use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(EventPicture::class, function (Faker $faker) {
    return [
        'event_id' => (Event::all()->count() > 0) ? Event::all()->random()->id : factory(Event::class, 100),
        'picture_id' => (Picture::all()->count() > 0) ? Picture::all()->random()->id : factory(Picture::class, 100),
    ];
});
