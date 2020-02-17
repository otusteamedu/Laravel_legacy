<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Catalog\Category;
use Faker\Generator as Faker;



$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->sentence(3);

    return [
        'parent_id'=>0,
        'title'=> $title,
        'visible'=> '1',
        'description' => $faker->text,
        'meta_title' => $title,
        'meta_description' => $faker->sentence(7),
        'url'=>$faker->domainWord,
        'order'=> rand(1, 50)
    ];
});