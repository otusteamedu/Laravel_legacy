<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Commit;
use App\Models\Repository;
use App\Models\Run;
use Faker\Generator as Faker;

$factory->define(Run::class, function (Faker $faker) {

    $url = 'https://github.com/' . $faker->word . '/' . $faker->word;
    $repository = factory(Repository::class)->create(['url' => $url]);
    $commit = factory(Commit::class)->create(['repository_id' => $repository->id]);

    return [
        'url' => $url,
        'repository_id' => $repository->id,
        'commit_id' => $commit->id,
        'worktime' => random_int(10, 1000),
        'ip' => $faker->ipv4,
    ];
});
