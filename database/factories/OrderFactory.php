<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'=>1,
        'date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'sum'=>0,
        'number'=>'',
        'delivery_type'=>'',
        'address'=>'',
        'processed_by'=>'',
        'comments'=>'',
        'on_control'=>false
    ];
});
