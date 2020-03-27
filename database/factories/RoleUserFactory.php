<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

$factory->define(RoleUser::class, function () {
    return [
        'role_id' => factory(Role::class, 1)->create()->first()->id,
        'user_id' => factory(User::class, 1)->create()->first()->id,
    ];
});
