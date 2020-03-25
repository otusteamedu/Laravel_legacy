<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use App\Models\File;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

Factory::define(News::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'text'=>$faker->text,
        'meta_title'=>$faker->title,
        'meta_description'=>'Meta-desc',
        'url'=>$faker->domainWord


    ];
});
