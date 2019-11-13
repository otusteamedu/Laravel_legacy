<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Handbook;
use App\Models\Journal;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Material::class, function (Faker $faker) {

    $selectionMaterials = [
        'PHP для чайников',
        'laravel для чайников',
        'mysql для чайников',
        'грокаем алгоритмы',
    ];


    $filesUrls = [
        public_path() . '/files/file1.jpg',
        public_path() . '/files/file2.jpg',
        public_path() . '/files/file3.jpg',
        public_path() . '/files/file4.jpg',
        public_path() . '/files/file5.jpg',
    ];

    $previewPicturesUrls = [
        public_path() . '/files/file1.jpg',
        public_path() . '/files/file2.jpg',
        public_path() . '/files/file3.jpg',
        public_path() . '/files/file4.jpg',
        public_path() . '/files/file5.jpg',
    ];

    $types = ['Бумага', 'Аудио', 'E-BOOK'];
    $formats = ['PDF', 'WORD'];


    shuffle($selectionMaterials);
    shuffle($filesUrls);
    shuffle($previewPicturesUrls);
    shuffle($formats);
    shuffle($types);

    $material = array_shift($selectionMaterials);
    $file = array_shift($filesUrls);
    $preview = array_shift($filesUrls);
    $format = array_shift($formats);
    $type = array_shift($types);

    return [
        'name' => $material,
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },

        'status_id' => function () {
            return factory(Handbook::class)->create()->id;
        },
        'file' => $file,
        'preview_image' => $preview,
        'format' => $format,
        'type' => $type,
        'description' => $faker->text(1000),
        'year_publishing' => $faker->numberBetween(1980, 2019)
    ];
});
