<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Catalog\Specification;
use Faker\Generator as Faker;

$factory->define(Specification::class, function (Faker $faker){
    $title = $faker->sentence(3);
    return [
        'title'=> $title
    ];
});
