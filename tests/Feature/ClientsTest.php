<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\User;
use GroupSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ClientsTest
 *
 * @group client
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
        $this->actingAs($this->getUser());

        $response = $this->get(route('clients.index'));
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
     * Тест просмотра страницы добавления клиента
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->getUser())->get(route('clients.create'));
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

        $this->actingAs($this->getUser());

        $response = $this->post(route('clients.store'), $data);
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));
        $response->assertSeeText($data['name']);
    }

    /**
     * Тест просмотра карточки клиента
     *
     * @return void
     */
    public function testShow()
    {
        $client = User::whereGroupId(Group::CLIENTS)->first();

        $this->actingAs($this->getUser());

        $response = $this->get(route('clients.show', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->get(route('clients.show', ['client' => $client->id]));
        $response->assertStatus(200);
    }

    /**
     * Тест просмотра страницы редактирования данных клиента
     *
     * @return void
     */
    public function testEdit()
    {
        $client = User::whereGroupId(Group::CLIENTS)->first();

        $this->actingAs($this->getUser());

        $response = $this->get(route('clients.edit', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->get(route('clients.edit', ['client' => $client->id]));
        $response->assertStatus(200);
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
        $client = User::whereGroupId(Group::CLIENTS)->first();

        $this->actingAs($this->getUser());

        $response = $this->put(route('clients.update', ['client' => $this->faker->numberBetween(100, 1000)]), $data);
        $response->assertStatus(404);

        $response = $this->put(route('clients.update', ['client' => $client->id]), $data);
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));

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
        $client = User::whereGroupId(Group::CLIENTS)->first();

        $this->actingAs($this->getUser());

        $response = $this->get(route('clients.index'));
        $response->assertSeeText($client->name);

        $response = $this->delete(route('clients.destroy', ['client' => $this->faker->numberBetween(100, 1000)]));
        $response->assertStatus(404);

        $response = $this->delete(route('clients.destroy', ['client' => $client->id]));
        $response->assertStatus(302);

        $response = $this->get(route('clients.index'));
        $response->assertDontSee($client->name);

        $this->clearUsers();
    }
}
