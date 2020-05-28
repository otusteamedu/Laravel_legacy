<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Producer::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeBetween('-3 months','-2 months');
    $title = $faker->name;
    return [
        //
        "name"=>$title,
        "slug"=>Str::slug($title),
        'created_at' => $createdAt,
        'updated_at' => $createdAt
    ];
});
