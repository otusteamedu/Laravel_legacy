<?php
/**
 * Тесты для контроллера пользователей
 */

namespace Tests\Feature\Controllers;


use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    //use DatabaseTransactions;
    use RefreshDatabase;
    use WithFaker;

    private function getUserRepository(): UserRepositoryInterface
    {
        return app()->make(UserRepositoryInterface::class);
    }


    /**
     * @group cms
     * @group users
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->assertTrue($user->isAdmin());
        $this->actingAs($user)
            ->get(route('cms.users.index'))
            ->assertStatus(200)
            ->assertSeeText('Пользователи')
        ;
    }

    /**
     * @group cms
     * @group users
     */
    public function testIndexAccessDenied()
    {
        $user = UserGenerator::createModeratorUser();
        $this->assertTrue($user->isModerator());
        $this->actingAs($user)
            ->get(route('cms.users.index'))
            ->assertStatus(403)
        ;
    }

    /**
     * @group cms
     * @group users
     */
    public function testIndexWithUsers()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.users.index'))
            ->assertStatus(200)
            ->assertSeeText($user->name);
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
        ]);
    }


    /**
     * @group cms
     * @group users
     */
    public function testSearchUsers()
    {
        $user = UserGenerator::createAdminUser();
        $user2 = UserGenerator::createUser();
        $this->actingAs($user)
            ->post(route('cms.users.index'), ['search' => $user2->name])
            ->assertStatus(200)
            ->assertSeeText($user2->email)
            ->assertDontSeeText($user->email)
        ;
    }

    /**
     * @group cms
     * @group users
     */
    public function testCreateUser()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateUserCreateData();
        $this->actingAs($user)
            ->post(route('cms.users.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
        ]);
    }

    /**
     * @group cms
     * @group users
     */
    public function testCreateUserDuplicate()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateUserCreateData();
        $this->actingAs($user)
        ->post(route('cms.users.store'), $data)
        ->assertStatus(200)
    ;
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
        ]);
        $this->actingAs($user)
            ->post(route('cms.users.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
                'email',
            ]);
        ;
    }

    /**
     * @group cms
     * @group users
     */
    public function testWontCreateUserWithoutName()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateUserCreateData();
        $name = $data['name'];
        unset($data['name']);
        $this->actingAs($user)
            ->post(route('cms.users.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
            ]);
        $this->assertDatabaseMissing('users', [
            'name' => $name,
            'email' => $data['email'],
            'level' => $data['level'],
        ]);
    }


    /**
     * @group cms
     * @group users
     */
    public function testUpdateUser()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateUserCreateData();
        $this->actingAs($user)
            ->post(route('cms.users.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
        $testUserId = User::where('name', $data['name'])->first()->id;
        $newData = $this->generateUserCreateData();
        $newData['id'] = $testUserId;

        $this->actingAs($user)
            ->post(route('cms.users.update'), $newData)
            ->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => $newData['name'],
        ]);
    }

    /**
     * @group cms
     * @group users
     */
    public function testDeleteUser()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateUserCreateData();
        $this->actingAs($user)
            ->post(route('cms.users.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
        $testUserId = User::where('name', $data['name'])->first()->id;

        $this->actingAs($user)
            ->post(route('cms.users.delete'), ['id' => $testUserId])
            ->assertStatus(200);
        $this->assertDatabaseMissing('users', [
            'name' => $data['name'],
        ]);
    }

    /**
     * @return array
     */
    private function generateUserCreateData(): array
    {
        return [
            'name' => $this->faker->name,
            'organization_id' => null,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'level' => User::LEVEL_USER,
        ];
    }
}
