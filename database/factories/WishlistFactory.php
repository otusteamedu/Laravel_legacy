<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Wishlist;
use Faker\Generator as Faker;

$factory->define(Wishlist::class, function (Faker $faker) {
    return [
        'user_id' =>  App\Models\User::pluck('id')->random(),
        'name'    => $faker->sentence(3),
    ];
});
