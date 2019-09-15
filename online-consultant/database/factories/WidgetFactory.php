<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Widget;
use Faker\Generator as Faker;

$factory->define(Widget::class, function (Faker $faker) {
    return [
        'domain' => $faker->domainName
    ];
});
