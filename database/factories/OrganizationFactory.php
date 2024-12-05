<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Organization;
use App\Models\Country;
use App\Models\OrgGroup;
use App\Models\OrgBranch;
use App\Models\OrgType;
use Faker\Generator as Faker;

$factory->define(Organization::class, function (Faker $faker) {
    $name = $faker->company;
    $nameEng = $name . ' [ENG]';
    return [
        'name' => $name,
        'name_eng' => $nameEng,
        'country_id' => Country::all()->random()->id,
        'org_branch_id' => OrgBranch::all()->random()->id,
        'org_group_id' => OrgGroup::all()->random()->id,
        'org_type_id' => OrgType::all()->random()->id,
    ];
});
