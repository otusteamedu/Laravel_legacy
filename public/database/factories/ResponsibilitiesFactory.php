<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Responsibility::class, function (Faker $faker) {

    return[
        'name'=>$faker->name,
    ];

});