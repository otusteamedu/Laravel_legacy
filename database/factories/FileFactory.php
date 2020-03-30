<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Intervention\Image\Facades\Image;
use \App\Helpers\File\Helper;

$factory->define(App\Models\File::class, function (Faker $faker, $attrs) {

    // Создаем файл для аватара
    $strFileSubdir = "app/public/upload";
    $strFilePath = storage_path($strFileSubdir);
    $intWidth = isset($attrs['width']) ? $attrs['width'] : 1024;
    $intHeight = isset($attrs['height']) ? $attrs['width'] : 1024;

    // Создаем файл в папке upload
    $strFileName = $faker->image($strFilePath, $intWidth, $intHeight, true);

    // Получаем массив для создания модели
    $arFile = Helper::getFileArray($strFileName);

    return array_merge($arFile, $attrs);
});
