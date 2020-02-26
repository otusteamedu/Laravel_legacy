<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Models\News::class, function (Faker $faker) {
    return [
        'title'=>$faker->title,
        'text'=>$faker->text,
        'meta_title'=>$faker->title,
        'meta_description'=>'Meta-desc',
        'url'=>$faker->domainWord


    ];
});

$factory->defineAs(App\Models\File::class, 'file', function(Faker $faker){
    return [
        'name'=>$faker->title
    ];

});
