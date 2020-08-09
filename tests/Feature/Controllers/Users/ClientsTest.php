<?php

namespace Tests\Feature\Users;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

/**
 * Class ClientsTest
 *
 * @group users
 * @group users.client
 * @package Tests\Feature
 */
class ClientsTest extends TestCase
{
    use WithFaker;

    /**
     * Тест просмотра списка клиентов
     *
     * @return void
     */
    public function testList()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('clients.index'));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы добавления клиента
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs(UserGenerator::generateAdmin())->get(route('clients.create'));
        $response->assertStatus(200);
    }

    /**
     * Тест добавления клиента
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

        $response = $this->post(route('clients.store'), $data);
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));
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

        $response = $this->post(route('clients.store'), $data);
        $response->assertStatus(302);

        $data['group_id'] = current(Group::CLIENTS);

        unset($data['password']);
        unset($data['password_confirmation']);

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Тест просмотра карточки клиента
     *
     * @return void
     */
    public function testShow()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $client = UserGenerator::generateClient();

        $response = $this->get(route('clients.show', ['client' => $client->id]));
        $response->assertStatus(200);

        $response->assertSeeText($client->email);
    }
    /**
     * Тест просмотра не существующей карточки клиента
     *
     * @return void
     */
    public function testShow404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('clients.show', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест просмотра страницы редактирования данных клиента
     *
     * @return void
     */
    public function testEdit()
    {
        $client = UserGenerator::generateClient();

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('clients.edit', ['client' => $client->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы редактирования данных не существующего клиента
     *
     * @return void
     */
    public function testEdit404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('clients.edit', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }

    /**
     * Тест обновления обновления клиента
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
        $client = UserGenerator::generateClient();

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->put(route('clients.update', ['client' => $client->id]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));

        $response->assertSeeText($data['name']);
        $response->assertSeeText($data['email']);
    }

    /**
     * Тест обновления обновления клиента в БЛ
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
        $client = UserGenerator::generateClient();

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->put(route('clients.update', ['client' => $client->id]), $data);
        $response->assertStatus(302);

        unset($data['password']);
        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Тест обновления обновления не существующего  клиента
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

        $response = $this->put(route('clients.update', ['client' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);
    }

    /**
     * Тест удаления клиента
     *
     * @return void
     */
    public function testDelete()
    {
        $client = UserGenerator::generateClient();

        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->get(route('clients.index'));
        $response->assertSeeText($client->name);

        $response = $this->delete(route('clients.destroy', ['client' => $client->id]));
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));
        $response->assertDontSee($client->name);
    }

    /**
     * Тест удаления клиента в БД
     *
     * @return void
     */
    public function testDeleteInDb()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $client = UserGenerator::generateClient();

        $this->assertDatabaseHas('users', ['id' => $client->id]);

        $response = $this->delete(route('clients.destroy', ['client' => $client->id]));
        $response->assertStatus(302);

        $this->assertSoftDeleted('users', ['id' => $client->id]);
    }

    /**
     * Тест удаления не существующего клиента
     *
     * @return void
     */
    public function testDelete404()
    {
        $this->actingAs(UserGenerator::generateAdmin());

        $response = $this->delete(route('clients.destroy', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);
    }
}
