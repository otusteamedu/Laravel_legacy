<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Operation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//use Faker\Generator;

class OperationsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexStatus()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('home'));

        $response->assertStatus(200);
    }

    public function testIndexViewHas()
    {
        $operation = factory(Operation::class)->create();
        $user = User::find($operation->user_id);
        $operationExpected = Operation::where('id', $operation->id)->with('category')->get();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertViewHasAll(['operations' => $operationExpected, 'incomeCount', 'consumptionCount']);
    }

    public function testCreateViewHas()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('operation.create'));

        $response->assertViewHas('categories');
    }

    public function testStoreIsRequired()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->from(route('operation.create'))->post(route('operation.store'), [
            'sum' => '',
            'category_id' => ''
        ]);

        $response->assertSessionHasErrors(['sum', 'category_id']);
    }

//    public function testStoreMaxValidateError()
//    {
//        $user = factory(User::class)->create();
//        $faker = \Faker\Factory::create();
//
//        $response = $this->actingAs($user)->from(route('operation.create'))->post(route('operation.store'), [
//            'sum' => 1000000000000,
//            'description' => $faker->sentence($nbWords = 1000, $variableNbWords = true)
//        ]);
//
//        $response->assertSessionHasErrors(['sum', 'description']);
//    }

    public function testStoreRedirect()
    {
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $response = $this->actingAs($user)->from(route('operation.create'))->post(route('operation.store'), [
            'sum' => 1000,
            'category_id' => $category->id,
            'description' => 'Тест контроллера'
        ]);

        $response->assertRedirect(route('home'));
    }

    public function testEditViewHas()
    {
        $operation = factory(Operation::class)->create();
        $user = User::find($operation->user_id);
        $response = $this->actingAs($user)->get(route('operation.edit', [
            'operation' => $operation
        ]));

        $response->assertViewHas(['operation', 'categories']);
    }

    public function testUpdateIsRequired()
    {
        $operation = factory(Operation::class)->create();
        $user = User::find($operation->user_id);

        $response = $this->actingAs($user)->from(route('operation.edit', ['operation' => $operation]))
            ->put(route('operation.update', [ 'operation' => $operation]), [
            'sum' => '',
            'category_id' => ''
        ]);

        $response->assertSessionHasErrors(['sum', 'category_id']);
    }

    public function testUpdateRedirect()
    {
        $operation = factory(Operation::class)->create();
        $user = User::find($operation->user_id);

        $response = $this->actingAs($user)->from(route('operation.edit', ['operation' => $operation]))
            ->put(route('operation.update', ['operation' => $operation]), [
                'sum' => 1500,
                'category_id' => $operation->category_id,
                'description' => 'Тест контроллера'
            ]);

        $response->assertRedirect(route('home'));
    }

    public function testDestroyRedirect()
    {
        $operation = factory(Operation::class)->create();
        $user = User::find($operation->user_id);

        $response = $this->actingAs($user)->from(route('home'))
            ->delete(route('operation.destroy', ['operation' => $operation]));

        $response->assertRedirect(route('home'));
    }
    /**
     * @param $period
     * @testWith ["yesterday"]
     * ["week"]
     * ["month"]
     * ["quarter"]
     * ["year"]
     */
//    public function testSetPeriodJsonReturn($period)
//    {
//        $operation = factory(OperationResource::class)->create();
//        $user = User::find($operation->user_id);
//
//        $response = $this->actingAs($user)->from(route('home'))
//            ->get(route('operation.period'), [
//                'period' => $period
//            ]);
//
//        $response->assertJson(['operations', 'incomeCount', 'consumptionCount']);
//    }
}
