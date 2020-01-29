<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {

    $domains = [
        'https://cacm.acm.org',
        'https://rjlipton.wordpress.com',
        'http://lambda-the-ultimate.org',
        'https://blog.regehr.org',
        'http://matt.might.net',
        'https://blog.computationalcomplexity.org',
        'https://www.johndcook.com',
        'https://science-professor.blogspot.ru',
        'http://www.scottaaronson.com',
        'https://compscigail.blogspot.com',
        'https://blog.codinghorror.com',
        'http://www.jasonernst.com',
        'https://terrytao.wordpress.com',
        'https://freedom-to-tinker.com',
        'https://youngfemalescientist.blogspot.com'
    ];

    $i = $faker->passthrough(mt_rand(0, 14));

    $data = [
        'name' => $domains[$i],
        'description' => $faker->text,
        'report_day' => rand(1, 30)
    ];

    return $data;
});
