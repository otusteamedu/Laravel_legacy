<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Mlink;

$factory->define(Mlink::class, function (Faker $faker) {

    $created = $faker->dateTimeBetween('-2 months', '-1 days');
    $link = $faker->url();

    $data = [
        'mpoll_id' => rand(1, 5),
        'user_id' => rand(1, 2),
        'link' => $link,
        'status' => rand(1, 2),
        'user_ip' => $faker->ipv4(),
        'created_at' => $created,
        'updated_at' => $created,
    ];

    return $data;
});

