<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use App\Models\EventPicture;
use App\Models\Picture;
use Faker\Generator as Faker;

$factory->define(EventPicture::class, function (Faker $faker) {
    return [
        'event_id' => factory(Event::class, 1),
        'picture_id' => factory(Picture::class, 1),
    ];
});
