<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Company::class, function (Faker $faker) {

    $inn = str_replace('.', '', $faker->unique()->ipv4);
    return [
        'name' => $faker->company,
        'inn' => intval($inn)
    ];
});
