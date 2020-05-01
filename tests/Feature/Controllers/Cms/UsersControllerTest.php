<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\User;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getUserRepository(): UserRepositoryInterface
    {
        return app()->make(UserRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group users
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.users.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group users
     * @group testIndexWithUsers
     */
    public function testIndexWithUsers()
    {
        $user = UserGenerator::createMoscow();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.users.index'))
            ->assertStatus(200)
            ->assertSeeText($user->name);
    }

    /**
     * @group cms
     * @group users
     * @group testUnAuthicatedUserWontCreateUserAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateUserAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateUserCreateData();
        $this->post(route('cms.users.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group users
     * @group testCreateUser
     * @return void
     */
    public function testCreateUser()
    {
        $data = $this->generateUserCreateData();
        $this->createUser($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(User::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group users
     * @group testCreateUserFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateUserFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.users.store'), [
                'country_id' => function(){
                    return factory(App\Models\Country::class)->create()->id;
                },
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, User::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group users
     * @group testCreateUserFailsIfNameIsEmpty
     * @return void
     */

    public function testCreateUserFailsIfCountryIdIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.users.store'), [
                'name' => $this->faker->user,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, User::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group users
     * @group testCreateUserFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateUserFailsIfParamsAreEmpty()
    {
        $this->createUser([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, User::all()->count());
    }

    /**
     * @return array
     */
    private function generateUserCreateData(): array
    {
        return [
            'name' => $this->faker->user,
            'country_id' => function(){
                return factory(App\Models\Country::class)->create()->id;
            }
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createUser(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.users.store'), $data);
    }

}
