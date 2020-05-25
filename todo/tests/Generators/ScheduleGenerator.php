<?php

namespace Tests\Generators;


use App\Models\Style;
use App\Models\Instructor;
use App\Models\Schedule;


class ScheduleGenerator
{
    public static function createSchedule(array $data = [])
    {
        //PermissionGenerator::createPermission(['id' => Permission::PERMISSION_ALL, 'name' => 'Полный доступ', 'route' => Permission::PERMISSION_ALL_ROUTE]);
        //RoleGenerator::createRole(['id' => User::USER_ROLE_ADMIN, 'name' => 'Admin'], [Permission::PERMISSION_ALL]);
        factory(Style::class, 1)->create(['style_id' => $data['style_id']]);
        factory(Instructor::class, 1)->create(['instructor_id' => $data['instructor_id']]);
        return factory(Schedule::class, 1)->create($data);
    }
}