<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Group::class, function (Faker $faker) {
    $groups=[
        'Класс 1А',
        'Класс 3Б',
        'Класс 2Д',
        'Класс 1Г',
        'Класс 4А',
        'Группа Капельки',
        'группа Кузнечики',
    ];

    shuffle($groups);
    $group = array_shift($groups);
    return[
        'name'=>$group,
    ];

});