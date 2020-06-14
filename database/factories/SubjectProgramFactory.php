<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubjectProgram;
use Faker\Generator as Faker;
use Illuminate\Support\Collection;

$factory->define(SubjectProgram::class, function (Faker $faker) {
    $meta = [];
    rand(0, 1) && $meta['annotation'] = $faker->text();
    rand(0, 1) && $meta['questions'] = Collection::times(rand(0, 10), function (int $i) use ($faker): string {
        return $faker->text(50);
    })->all();
    rand(0, 1) && $meta['text'] = $faker->text();
    rand(0, 1) && $meta['bibliography'] = Collection::times(rand(0, 10), function (int $i) use ($faker): string {
        return $faker->url;
    })->all();
    rand(0, 1) && $meta['attachments'] = Collection::times(rand(0, 10), function (int $i) use ($faker): string {
        return $faker->text(50);
    })->all();

    return [
        'title' => $faker->unique()->words(3, true),
        'meta' => json_encode($meta),
        'sort' => rand(0, 100),
    ];
});
