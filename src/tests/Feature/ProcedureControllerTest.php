<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class BusinessControllerTest
 * @package Tests\Feature
 * @group ProcedureController
 */
class ProcedureControllerTest extends TestHelper
{
    use RefreshDatabase;

    const TABLE_NAME = 'procedures';

    /**
     * @var Business
     */
    private $business;
    /**
     * @var User
     */
    private $user;

    /**
     * Страница добавления записи
     */
    public function testCreateView()
    {
        $this->getBusiness($this->user);

        $response = $this->get(route('procedure.create'));

        $response->assertStatus(200);
    }

    /**
     * Главная страница
     */
    public function testIndexView()
    {
        $this->getBusiness($this->user);

        $response = $this->get(route('procedure.index'));

        $response->assertStatus(200);
    }

    /**
     * Страница редактирования
     */
    public function testEditView()
    {
        $business = $this->getBusiness($this->user);
        $procedure = $this->getProcedure($business);

        $response = $this->get(route('procedure.edit', ['procedure' => $procedure->id]));

        $response->assertStatus(200);
    }

    /**
     * Страница просмотра деталей
     */
    public function testShowView()
    {
        $business = $this->getBusiness($this->user);
        $procedure = $this->getProcedure($business);

        $response = $this->get(route('procedure.show', ['procedure' => $procedure->id]));

        $response->assertStatus(200);
    }

    /**
     * Проверка статуса при переходе на страницу не своей процедуры
     */
    public function testErrorEditDontMyBusiness()
    {
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $response = $this->get(route('procedure.edit', ['procedure' => $procedure->id]));

        $response->assertStatus(403);
    }

    /**
     * Ошибка при переходе на страницу не своей процедуры
     */
    public function testErrorShowDontMyBusiness()
    {
        $user = $this->getUser();
        $business = $this->getBusiness($user);
        $procedure = $this->getProcedure($business);

        $response = $this->get(route('procedure.show', ['procedure' => $procedure->id]));

        $response->assertStatus(403);
    }

    /**
     * Проверка статуса при переходе на страницу без созданного бизнеса
     */
    public function testErrorIndexWithoutBusiness()
    {
        $response = $this->get(route('procedure.index'));

        $response->assertStatus(403);
    }

    /**
     * Проверка статуса при переходе на страницу без созданного бизнеса
     */
    public function testErrorCreateWithoutBusiness()
    {
        $response = $this->get(route('procedure.create'));

        $response->assertStatus(403);
    }

    /**
     * Проверка заполнения формы
     * @dataProvider getStoreRequestData
     * @param array $data
     * @param string $hasError
     */
    public function testErrorsStore($data, $hasError)
    {
        $this->getBusiness($this->user);

        $response = $this->post(route('procedure.store'), $data);

        $response->assertSessionHasErrors([$hasError]);
        $this->assertDatabaseMissing(self::TABLE_NAME, $data);
    }

    /**
     * Добавление записи
     */
    public function testStore()
    {
        $data = [
            'name' => Str::random(30),
            'duration' => rand(1, 127),
            'price' => rand(1, 20000),
            'people_count' => rand(1, 127)
        ];
        $this->getBusiness($this->user);

        $this->assertDatabaseMissing(self::TABLE_NAME, $data);
        $response = $this->post(route('procedure.store'), $data);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas(self::TABLE_NAME, $data);
    }

    /**
     * Обновление данных
     */
    public function testUpdate()
    {
        $business = $this->getBusiness($this->user);
        $procedure = $this->getProcedure($business);
        $data_old = [
            'name' => $procedure->name,
            'duration' => $procedure->duration,
            'price' => $procedure->price,
            'people_count' => $procedure->people_count
        ];
        $data_new = [
            'name' => Str::random(30),
            'duration' => rand(1, 127),
            'price' => rand(1, 20000),
            'people_count' => rand(1, 127)
        ];

        $this->assertDatabaseHas(self::TABLE_NAME, $data_old);
        $response = $this->patch(route('procedure.update', ['procedure' => $procedure->id]), $data_new);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing(self::TABLE_NAME, $data_old);
        $this->assertDatabaseHas(self::TABLE_NAME, $data_new);
        $response->assertRedirect(route('procedure.index'));
    }

    /**
     * Удаление записи
     */
    public function testDelete()
    {
        $business = $this->getBusiness($this->user);
        $procedure = $this->getProcedure($business);

        $response = $this->delete(route('procedure.destroy', ['procedure' => $procedure->id]));

        $this->assertDatabaseMissing(self::TABLE_NAME, ['id' => $procedure->id]);
        $response->assertRedirect(route('procedure.index'));
    }

    /**
     * Ошибка удаления чужой записи
     */
    public function testErrorDeleteDontMyProcedure()
    {
        $business = factory(Business::class)->create();
        $procedure = $this->getProcedure($business);

        $response = $this->delete(route('procedure.destroy', ['procedure' => $procedure->id]));

        $this->assertDatabaseHas(self::TABLE_NAME, ['id' => $procedure->id]);
        $response->assertStatus(403);
    }

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $role = factory(UserRole::class)->create();
        $this->user = factory(User::class)->create([
            'user_role_id' => $role->id,
        ]);

        $this->actingAs($this->user);
    }

    /**
     * Данные для проверки на ошибки заполнения формы
     * @return array
     */
    public function getStoreRequestData()
    {
        $procedure = [
            'name' => Str::random(30),
            'duration' => rand(1, 127),
            'price' => rand(1, 20000),
            'people_count' => rand(1, 127)
        ];

        return [
            [
                [
                    'duration' => $procedure['duration'],
                    'price' => $procedure['price'],
                    'people_count' => $procedure['people_count'],
                ],
                'name',
            ],
            [
                [
                    'name' => $procedure['name'],
                    'price' => $procedure['price'],
                    'people_count' => $procedure['people_count'],
                ],
                'duration',
            ],
            [
                [
                    'name' => $procedure['name'],
                    'duration' => $procedure['duration'],
                    'people_count' => $procedure['people_count'],
                ],
                'price',
            ],
            [
                [
                    'name' => $procedure['name'],
                    'duration' => $procedure['duration'],
                    'price' => $procedure['price'],
                ],
                'people_count',
            ],
            [
                [
                    'name' => Str::random(160),
                    'duration' => $procedure['duration'],
                    'price' => $procedure['price'],
                    'people_count' => $procedure['people_count'],
                ],
                'name',
            ],
            [
                [
                    'name' => $procedure['name'],
                    'duration' => 12000,
                    'price' => $procedure['price'],
                    'people_count' => $procedure['people_count'],
                ],
                'duration',
            ],
            [
                [
                    'name' => $procedure['name'],
                    'duration' => $procedure['duration'],
                    'price' => $procedure['price'],
                    'people_count' => 23000,
                ],
                'people_count',
            ],
        ];
    }
}
