<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $images = [
        '7428_10618990154_3180141f73_z_640_480_nofilter.jpg',
        '65535_48263805617_485bfa0657_c_640_480_nofilter.jpg',
        '65535_48918317967_70a0b14c9f_b_640_480_nofilter.jpg',
        '65535_48927274412_5349d3e66c_z_640_480_nofilter.jpg',
        '65535_49000817733_bc6cb263f2_z_640_480_nofilter.jpg',
        '65535_49287288812_cc3ab56551_c_640_480_nofilter.jpg',
        ];
    $item = random_int(0, 5);
    return [
        'name' => $faker->text(20),
        'image' => $images[$item],
            //$faker->image('public/storage/images',640,480, null, false),
        'content' => $faker->realText(400),
        'link' => $faker->url,
        'slug' => $faker->slug(10),
        'title' => $faker->text(20),
        'keywords' => $faker->text(20),
        'description' => $faker->text(50),
    ];
});
