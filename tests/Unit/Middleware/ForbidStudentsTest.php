<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\ForbidStudents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

/**
 * Class ForbidStudents
 * @package Tests\Unit\Middleware
 * @group middleware
 */
class ForbidStudentsTest extends TestCase
{
    public function testHandle(): void
    {
        $this->seed(\RoleSeeder::class);

        /**
         * Success
         */
        $request = new Request();
        $request->setUserResolver(function () {
            return factory(User::class)->make([
                'role_id' => Role::TEACHER,
            ]);
        });
        $middleware = app(ForbidStudents::class);

        $this->assertEquals($request, $middleware->handle($request, function ($request) {
            return $request;
        }));

        /**
         * Exception
         */
        $request = new Request();
        $request->setUserResolver(function () {
            return factory(User::class)->make([
                'role_id' => Role::STUDENT,
            ]);
        });
        $middleware = app(ForbidStudents::class);

        $this->expectExceptionObject(new HttpException(404));
        $middleware->handle($request, function ($request) {
            return $request;
        });
    }
}
