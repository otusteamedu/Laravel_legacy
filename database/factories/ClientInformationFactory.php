<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ClientInformation;
use Faker\Generator as Faker;

$factory->define(ClientInformation::class, static function (Faker $faker) {
    return [
        'material' => $faker->word,
        'note' => $faker->text(255),
    ];
});
