<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mpoll;
use Faker\Generator as Faker;

$factory->define(Mpoll::class, function (Faker $faker) {
    $created = $faker->dateTimeBetween('-2 months', '-1 days');
    return [
//            'id' => 1,
            'name' => 'Survey for 0.6£ YS Oct.',
            'created_at' => $created,
            'updated_at' => $created,
            'mstatus_id' => 1,
            'mtype_id' => 5,
            'starttime' => NULL,
            'endtime' => NULL,
            'price' => '0.60',
            'description' => 'Survey for £0.' . rand(1,9),
            'click' => rand(2, 5000),
            'repeatable' => 1,
            'country_id' => 21,
            'length' => '',
            'survlimit' => NULL,
            'prescreener' => '',
            'singleLink' => $faker->url() .'?sub=[SUB]',
//            'singleLink' => 'http://www.your-surveys.com/?si=488&ssi=[SUB]',
            'filename' => '',
            'key' => NULL,
            'incabinet' => 1,
            'cab_link' => 'https://link.luxsurveys.com/mpolls/poll/XXX',
            'cab_price' => '0.6£',
            'completes' => rand(2, 5000),
            'overquotas' => rand(2, 5000),
            'screenout' => 0,
            'mail_id' => 32,
            'check_geo' => rand(0,1),
            'customer_id' => 8,
            'created_user_id' => 1,
    ];
});
