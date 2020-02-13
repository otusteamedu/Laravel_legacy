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


    $seedsUploadImageDir = config('seeds.seeds_uploads_path');
//    $seedsImageDir = config('seeds.seeds_path');

    $files = scandir($seedsUploadImageDir);

    $images = array_filter($files, function ($file) use ($seedsUploadImageDir) {
       return isImageValid(($seedsUploadImageDir . '/' . $file));
    });

    $firstImagesIndex = key($images);
    $randIndex = rand($firstImagesIndex, count($images) - 1);

    $imagePath = $seedsUploadImageDir . '/' . $images[$randIndex];

    $uploadedImage = getUploadedFileFromPath($imagePath, true);


//    while (!isImageValid($uploadedImage)) {
//        $uploadedImage = getUploadedFileFromPath($faker->image(null, $randomSize['width'], $randomSize['height']), true);
//    }

//    return uploader()->upload($uploadedImage, $uploadDir);

    return [];
});

