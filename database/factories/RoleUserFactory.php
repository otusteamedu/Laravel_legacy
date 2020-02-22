<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Faker\Generator as Faker;

$factory->define(RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => Role::where(['name' => 'moderators'])->first()->id,
        'user_id' => (User::all()->count() > 0) ? User::all()->random()->id : factory(User::class, 100),
    ];
});
