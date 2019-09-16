<?php
use App\Models\Post\Post;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'status' => Post::STATUS_PUBLISHED,
        'slug' => $faker->unique()->slug,
        'image' => $faker->imageUrl(),
        'title' => $faker->title,
        'short_text' => $faker->text(250),
        'text' => $faker->text(100),
        'keywords' => null,
        'description' => $faker->text(150),
        'canonical_url' => null,
        'meta_tags' => null,
        'user_id' => 1,
        'category_id' => 1,
        'published_at' => date('Y-m-d H:i:s'),
    ];
});