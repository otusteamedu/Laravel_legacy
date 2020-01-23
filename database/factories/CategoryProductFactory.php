<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\CategoryProduct;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(CategoryProduct::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description'=>$faker->text,
    ];
});
