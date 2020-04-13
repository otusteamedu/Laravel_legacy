<?php

namespace Tests\Generators;

use App\Models\Permission;


class PermissionGenerator
{
    public static function createPermission(array $data = [])
    {
        return factory(Permission::class, 1)->create($data);
    }
}