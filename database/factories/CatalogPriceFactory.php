<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Catalog\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    $title = $faker->sentence(1);
    return [
        'name'=>$title
    ];
});
