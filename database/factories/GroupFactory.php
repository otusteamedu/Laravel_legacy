<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
    ];
});
