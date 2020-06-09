<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Document::class, function (Faker $faker) {
    return [
        'number' => $faker->randomLetter . '/' . substr($faker->isbn10, 2, 6)
    ];
});
