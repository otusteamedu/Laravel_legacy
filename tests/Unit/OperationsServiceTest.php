<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Category;
use App\Models\Operation;
use App\Services\OperationsService;
use App\Repositories\OperationRepository;
use App\Handles\OperationsHandle;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OperationsServiceTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @group operations
     */
    public function testGetUserTodayOperations()
    {
        $operationService = app()->make(OperationsService::class);

        $operationExpect = factory(Operation::class)->create();
        $operationAssert = $operationService->getUserTodayOperations($operationExpect->user_id);
        $this->assertEquals($operationExpect->id, $operationAssert[0]->id);
    }

    public function testGetIncomeCount()
    {
        $user = factory(User::class)->states('user_id_1')->create();
        $category = factory(Category::class)->states('type_income')->create();
        $operations = factory(Operation::class, 2)->states('type_income')->create();

        $sumExpect = 2000;
        $operationService = app()->make(OperationsService::class);
        $sumAssert = $operationService->getIncomeConsumptionCount($operations);

        $this->assertEquals($sumExpect, $sumAssert['incomeCount']);
    }

    public function testGetConsumptionCount()
    {
        $user = factory(User::class)->states('user_id_1')->create();
        $category = factory(Category::class)->states('type_consumption')->create();
        $operations = factory(Operation::class, 2)->states('type_consumption')->create();

        $sumExpect = 2000;
        $operationService = app()->make(OperationsService::class);
        $sumAssert = $operationService->getIncomeConsumptionCount($operations);

        $this->assertEquals($sumExpect, $sumAssert['consumptionCount']);
    }

    public function testStoreOperation()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $operationService = app()->make(OperationsService::class);
        $operationService->storeOperation([
            'sum' => 1000,
            'category_id' => $category->id,
            'description' => 'Тест добавления операции в БД',
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('operations', [
            'sum' => 1000,
            'category_id' => $category->id,
            'description' => 'Тест добавления операции в БД',
            'user_id' => $user->id
        ]);
    }

    public function testUpdateOperation()
    {
        $operation = factory(Operation::class)->create();

        $operationService = app()->make(OperationsService::class);
        $operationService->updateOperation([
            'sum' => 5500,
            'category_id' => $operation->category_id,
            'description' => 'Тест редактирования существующей операции'
        ],$operation);

        $this->assertDatabaseHas('operations', [
            'id' => $operation->id,
            'sum' => 5500,
            'category_id' => $operation->category_id,
            'description' => 'Тест редактирования существующей операции',
            'user_id' => $operation->user_id
        ]);
    }

    public function testDestroyOperation(){
        $operation = factory(Operation::class)->create();

        $operationService = app()->make(OperationsService::class);
        $operationService->destroyOperation($operation->id);

        $this->assertDeleted($operation);
    }

    /**
     * @param $period
     * @testWith ["yesterday"]
     * ["week"]
     * ["month"]
     * ["quarter"]
     * ["year"]
     */
    public function testGetUserOperationsForPeriod($period)
    {
        $operationExpect = factory(Operation::class)->state($period)->create();

        $operationService = app()->make(OperationsService::class);
        $operationAssert = $operationService->getUserOperationsForPeriod($operationExpect->user_id, $period);
        $this->assertEquals($operationExpect->id, $operationAssert[0]->id);
    }
}
