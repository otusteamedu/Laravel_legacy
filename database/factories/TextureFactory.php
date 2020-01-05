<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Texture;
use Faker\Generator as Faker;

$factory->define(Texture::class, function (Faker $faker) {
    $uploadDir = public_path(config('uploads.image_upload_path'));

    $thumbSize = config('uploads.texture_image_sizes.thumb');
    $sampleSize = config('uploads.texture_image_sizes.sample');
    $backgroundSize = config('uploads.texture_image_sizes.background');

    $uploadedThumb = getFakerImage($thumbSize['width'], $thumbSize['height'], 'abstract');
    $thumbAttributes = uploader()->upload($uploadedThumb, $uploadDir);

    $uploadedSample = getFakerImage($sampleSize['width'], $sampleSize['height'], 'abstract');
    $sampleAttributes = uploader()->upload($uploadedSample, $uploadDir);

    $uploadedBackground = getFakerImage($backgroundSize['width'], $backgroundSize['height']);
    $backgroundAttributes = uploader()->upload($uploadedBackground, $uploadDir);

    return [
        "name" => $faker->unique()->city,
        "thumb_path" => $thumbAttributes['path'],
        "sample_path" => $sampleAttributes['path'],
        "background_path" => $backgroundAttributes['path'],
        "width" => $faker->numberBetween(100,130),
        "price" => $faker->numberBetween(800,1500),
        "description" => $faker->realText(),
        "publish" => 1
    ];
});
