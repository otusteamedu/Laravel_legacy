<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Catalog\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker){
    $title = $faker->sentence(3);
    return [
        'title'=> $title,
        'description' => $faker->text,
        'meta_title' => $title,
        'meta_description' => $faker->sentence(8),
        'url'=> $faker->domainWord,
        'order'=>  rand(1, 50)
    ];
});

