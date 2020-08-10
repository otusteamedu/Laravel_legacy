<?php

namespace Tests\Feature\Controllers\Api\Users;

use App\Models\EducationYear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Tests\Generators\GroupGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;
use Tests\Traits\ApiAuth;

/**
 * GET v1.0.0/userinfo
 * Class UserInfoUserControllerTest
 * @package Tests\Feature\Controllers\Api\Users
 * @group api_users
 */
class UserInfoUserControllerTest extends TestCase
{
    use ApiAuth;
    use RefreshDatabase;

    const BASE_URL = 'v1.0.0/userinfo/';

    private $group;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\RoleSeeder::class);
        $this->seed(\EducationYearSeeder::class);
        $this->group = GroupGenerator::generateGroup([
            'education_year_id' => EducationYear::current()->first()->id,
        ]);
    }

    public function testGet200(): void
    {
        $user = UserGenerator::generateTeacher();
        Passport::actingAs($user, ['userinfo', 'messages']);

        $this->json(Request::METHOD_GET, static::BASE_URL)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $user->id,
                    'last_name' => $user->last_name,
                    'name' => $user->name,
                    'second_name' => $user->second_name,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'role' => [
                        'id' => $user->role->id,
                        'name' => $user->role->name,
                    ],
                ],
            ]);
    }

    /**
     * @return string
     */
    private function getUri(): string
    {
        return static::BASE_URL;
    }

    /**
     * @return string
     */
    private function getMethod(): string
    {
        return Request::METHOD_GET;
    }
}
