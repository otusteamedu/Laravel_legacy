<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    $uploadDir = public_path(config('uploads.image_upload_path'));
    $imageSize = config('uploads.category_image_size');

    $uploadedImage = getFakerImage($imageSize['width'], $imageSize['height']);
    $imageAttributes = uploader()->upload($uploadedImage, $uploadDir);

    return [
        "type" => 'topics',
        "alias" => $faker->unique()->safeColorName,
        "title" => $faker->unique()->streetName,
        "image_path" => $imageAttributes['path'],
        "publish" => 1,
        "description" => $faker->text(),
        "keywords" => implode(', ', $faker->words())
    ];
});
