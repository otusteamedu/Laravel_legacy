<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;

// Метод хоть и пуст, но без него ItemsTableSeeder выкинет ошибку
$factory->define(Item::class, function (Faker $faker) {
    return [
        //
    ];
});
