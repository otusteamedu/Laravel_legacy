<?php

namespace Tests\Unit\Services;

use App\DTOs\DTOInterface;
use App\DTOs\UserDTO;
use App\Models\Role;
use App\Models\User;
use App\Services\Users\UserService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class UserServiceTest
 * @package Tests\Unit\Services
 * @group user
 */
class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserService
     */
    protected $service;
    /**
     * @var User
     */
    protected $user;
    /**
     * @var DTOInterface
     */
    protected $DTO;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(UserService::class);

        $this->seed(\RoleSeeder::class);

        $this->user = factory(User::class)->create([
            'role_id' => Role::METHODIST,
        ]);

        $faker = Factory::create(Factory::DEFAULT_LOCALE);

        $this->DTO = UserDTO::fromArray([
            UserDTO::LAST_NAME => $faker->lastName,
            UserDTO::NAME => $faker->firstName,
            UserDTO::ROLE_ID => Role::METHODIST,
            UserDTO::SECOND_NAME => $faker->firstName,
            UserDTO::EMAIL => $faker->email,
            UserDTO::PASSWORD => 'password',
        ]);
    }

    public function testStore(): void
    {
        $this->assertDatabaseMissing('users', [
            'last_name' => $this->DTO->toArray()[UserDTO::LAST_NAME],
        ]);
        $this->assertInstanceOf(User::class, $this->service->store($this->DTO));
        $this->assertDatabaseHas('users', [
            'last_name' => $this->DTO->toArray()[UserDTO::LAST_NAME],
        ]);
    }

    public function testUpdate(): void
    {
        $this->assertDatabaseMissing('users', [
            'last_name' => $this->DTO->toArray()[UserDTO::LAST_NAME],
        ]);
        $this->assertInstanceOf(User::class, $this->service->update($this->DTO, $this->user));
        $this->assertDatabaseHas('users', [
            'last_name' => $this->DTO->toArray()[UserDTO::LAST_NAME],
        ]);
    }

    public function testDelete(): void
    {
        $this->assertDatabaseHas('users', [
            'last_name' => $this->user->last_name,
        ]);
        $this->assertTrue($this->service->delete($this->user));
        $this->assertNull(User::find($this->user->id));
    }
}
