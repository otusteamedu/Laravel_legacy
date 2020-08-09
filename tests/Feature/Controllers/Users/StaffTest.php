<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class StaffTest
 *
 * @group   users
 * @group   users.staff
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
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('staffs.index'));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы добавления сотрудника
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs(UserGenerator::generateAdmin())->get(route('staffs.create'));
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

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->post(route('staffs.store'), $data);
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест создания клиента в БД
     *
     * @return void
     */
    public function testStoreInDb()
    {
        $data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => $this->faker->password,
        ];
        $data['password_confirmation'] = $data['password'];

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->post(route('staffs.store'), $data);
        $response->assertStatus(302);

        unset($data['password']);
        unset($data['password_confirmation']);

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Тест просмотра карточки сотрудника
     *
     * @return void
     */
    public function testShow()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $response = $this->get(route('staffs.show', ['staff' => $staff->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра карточки не существующего сотрудника
     *
     * @return void
     */
    public function testShow404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('staffs.show', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест просмотра страницы редактирования данных сотрудника
     *
     * @return void
     */
    public function testEdit()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $response = $this->get(route('staffs.edit', ['staff' => $staff->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы редактирования данных не существующего сотрудника
     *
     * @return void
     */
    public function testEdit404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('staffs.edit', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест обновления сотрудника
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

        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $response = $this->put(route('staffs.update', ['staff' => $staff->id]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));

        $response->assertSeeText($data['name']);
        $response->assertSeeText($data['email']);
    }

    /**
     * Тест обновления обновления сотрудника в БЛ
     *
     * @return void
     */
    public function testUpdateInDb()
    {
        $data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => null,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $response = $this->put(route('staffs.update', ['staff' => $staff->id]), $data);
        $response->assertStatus(302);

        unset($data['password']);
        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Тест обновления не существуюшего сотрудника
     *
     * @return void
     */
    public function testUpdate404()
    {
        $data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => null,
        ];

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->put(route('staffs.update', ['staff' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);
    }

    /**
     * Тест удаления сотрудника
     *
     * @return void
     */
    public function testDelete()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $response = $this->get(route('staffs.index'));
        $response->assertSeeText($staff->name);

        $response = $this->delete(route('staffs.destroy', ['staff' => $staff->id]));
        $response->assertStatus(302);

        $response = $this->get(route('staffs.index'));
        $response->assertDontSee($staff->name);
    }

    /**
     * Тест удаления клиента в БД
     *
     * @return void
     */
    public function testDeleteInDb()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $staff = UserGenerator::generateStaff();

        $this->assertDatabaseHas('users', ['id' => $staff->id]);

        $response = $this->delete(route('staffs.destroy', ['staff' => $staff->id]));
        $response->assertStatus(302);

        $this->assertSoftDeleted('users', ['id' => $staff->id]);
    }

    /**
     * Тест удаления не существующего сотрудника
     *
     * @return void
     */
    public function testDelete404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->delete(route('staffs.destroy', ['staff' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }
}
