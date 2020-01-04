<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Image;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;


$factory->define(Image::class, function (Faker $faker)
{
    $uploadDir = public_path(config('uploads.image_upload_path'));
    $randomSize = Arr::random(config('uploads.image_sizes'));
    $uploadedImage = null;

    while (!isImageValid($uploadedImage)) {
        $uploadedImage = getUploadedFileFromPath($faker->image(null, $randomSize['width'], $randomSize['height']), true);
    }

    return uploader()->upload($uploadedImage, $uploadDir);
});

