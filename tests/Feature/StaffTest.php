<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use GroupSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class StaffTest
 *
 * @group   staff
 * @package Tests\Feature
 */
class StaffTest extends TestCase
{
    use WithFaker;

    /**
     * Тест просмотра списка сотрудников
     *
     * @return void
     */
    public function testList()
    {
        $this->actingAs($this->getUser());

        $response = $this->get(route('staffs.index'));
        $response->assertStatus(200);
    }

    /**
     * Получить пользователя
     *
     * @return User
     */
    protected function getUser(): User
    {
        static $user = null;

        if ($user) {
            return $user;
        }

        if (!Group::find(1)) {
            (new GroupSeeder())->run();
        }

        $this->clearUsers();

        $users = factory(User::class, 1)->create([
            'group_id' => Group::STAFF_ADMIN,
        ]);

        $user = $users->first();

        return $user;
    }

    /**
     * Удалить пользователей
     */
    protected function clearUsers()
    {
        User::withTrashed()->each(function (User $user) {
            $user->forceDelete();
        });
    }

    /**
     * Тест просмотра страницы добавления сотрудника
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->getUser())->get(route('staffs.create'));
        $response->assertStatus(200);
    }

    /**
     * Тест добавления сотрудника
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => $this->faker->password,
        ];
        $data['password_confirmation'] = $data['password'];

        $this->actingAs($this->getUser());

        $response = $this->post(route('staffs.store'), $data);
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест просмотра карточки сотрудника
     *
     * @return void
     */
    public function testShow()
    {
        $staff = $this->getUser();

        $this->actingAs($staff);

        $response = $this->get(route('staffs.show', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->get(route('staffs.show', ['staff' => $staff->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы редактирования данных сотрудника
     *
     * @return void
     */
    public function testEdit()
    {
        $staff = $this->getUser();

        $this->actingAs($staff);

        $response = $this->get(route('staffs.edit', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->get(route('staffs.edit', ['staff' => $staff->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест обновления обновления сотрудника
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => null,
        ];

        $staff = $this->getUser();

        $this->actingAs($staff);

        $response = $this->put(route('staffs.update', ['staff' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);

        $response = $this->put(route('staffs.update', ['staff' => $staff->id]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));

        $response->assertSeeText($data['name']);
        $response->assertSeeText($data['email']);
    }

    /**
     * Тест удаления сотрудника
     *
     * @return void
     */
    public function testDelete()
    {
        $user = $this->getUser();
        $staff = factory(User::class, 1)->create([
            'group_id' => Group::STAFFS[rand(0, 2)],
        ])->first();

        $this->actingAs($user);

        $response = $this->get(route('staffs.index'));
        $response->assertSeeText($staff->name);

        $response = $this->delete(route('staffs.destroy', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->delete(route('staffs.destroy', ['staff' => $staff->id]));
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));
        $response->assertDontSee($staff->name);

        $this->clearUsers();
    }
}
