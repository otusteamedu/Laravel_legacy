<?php

namespace Tests\Feature\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class TeacherControllerTest
 * @package Tests\Feature\Controllers
 * @group teacher
 * @group other
 */
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(\RoleSeeder::class);
        $this->seed(\EducationYearSeeder::class);

        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);
    }

    /**
     * GET /dashboard/teachers
     */
    public function testIndex(): void
    {
        $this->actingAs($this->user)
            ->get(route('dashboard'))
            ->assertOk();
    }
}
