<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\OrderStatus;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => rand(1, User::count()),
        'status_id' => rand(1, OrderStatus::count())
    ];
});
