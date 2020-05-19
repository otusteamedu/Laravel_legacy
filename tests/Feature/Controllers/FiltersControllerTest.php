<?php

namespace Tests\Feature\Controllers;

use App\Models\Filter;
use App\Models\FilterType;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use FilterTypesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\FilterGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class FiltersControllerTest extends TestCase
{
    // RefreshDatabase Перенакатывает все миграции
    use RefreshDatabase;
    use WithFaker;

    private function getFilterRepository(): FilterRepositoryInterface
    {
        return app()->make(FilterRepositoryInterface::class);
    }


    /**
     * A basic feature test example.
     * @group filter
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.filters.index'))
            ->assertStatus(200);
    }

    public function testIndexWithFilters()
    {
        //Show real Exceptions
        $this->withoutExceptionHandling();

        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();
        $this->actingAs($user)
            ->get(route('cms.filters.index'))
            ->assertStatus(200);
//        ->assertSeeText($filter->name);
    }

    public function testDeleteExistingFilter()
    {
        //Show real Exceptions
        $this->withoutExceptionHandling();
        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();
        $this->assertCount(1, Filter::all());

        $this->actingAs($user)
            ->delete(route('cms.filters.destroy', $filter))
            ->assertStatus(302)
            ->assertRedirect(route('cms.filters.index'));

        $this->assertCount(0, Filter::all());

    }


    public function testUnAuthUserWontCreateFilterAndRedirectOnLogin()
    {
//        $filter = FilterGenerator::createFilterAge();
        $filter = $this->generateFilterCreateData();
        $this->post(route('cms.filters.store'), $filter)
            ->assertStatus(302)
            ->assertRedirect('login');
//\Mail::assertNothingSent();
    }

    public function testWontCreatefilterWithoutDescription()
    {
        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();
        $filter['name'] = 'Test_Value';
        unset($filter['description']);
//        dd($data);
        $this->actingAs($user)
            ->post(route('cms.filters.store'), $filter->toArray())
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'description'
            ]);
//            ->assertRedirect(route('cms.filters.edit', $data));
        // Проверяем, что такой записи нет
        $this->assertDatabaseMissing('filters', [
            'name' => $filter['name']
        ]);
    }

    public function testCreateFilter()
    {
        $data = $this->generateFilterCreateData();
        $this->createFilter($data)
            ->assertStatus(302);
//Check , DB creates record
        $this->assertDatabaseHas('filters', [
            'name' => $data['name']
        ]);
        //Check that Filter name exists
        $this->assertNotNull(Filter::where('name', $data['name'])->first());

    }

    public function testCreateFilterStoresOnlyOneFilter()
    {
        $data = FilterGenerator::createFilterAge();
        $this->createFilter($data->toArray())
            ->assertStatus(302);
        $this->assertEquals(1, Filter::all()->count());
    }

    public function testUserOpenCreateForm()
    {
        //Show real Exceptions
        $this->withoutExceptionHandling();
        $this->seed(FilterTypesTableSeeder::class);
//        $this->seed();

        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.filters.create'))
            ->assertSeeText('ID of filter type')
            ->assertOk();

    }

    public function testUserOpenEditForm()
    {
        $this->seed(FilterTypesTableSeeder::class);
        $filter = FilterGenerator::createFilterAge(['name' => 'Test Name']);
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.filters.edit', $filter))
            ->assertSeeText('ID of filter type')
            ->assertSee('Test Name')
            ->assertOk();

    }

    public function testUserOpenEditFormWithNotExistingId()
    {
        $this->seed(FilterTypesTableSeeder::class);
        $filter = FilterGenerator::createFilterAge();
        $filter->id = rand(10, 100);
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.filters.edit', 20))
            ->assertStatus(404);
}

    /**
     * @covers App\Http\Controllers\Cms\Filters\FiltersController::update
     */
    public function testUpdateFilter()
    {
        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();
        $repository = $this->getFilterRepository();
        $repository->updateFromArray($filter, ['name' => 'TEST_VALUE']);

        $name = 'TEST_VALUE_CHANGES';
        $filter['name'] = $name;
        $this->actingAs($user)
            ->patch(route('cms.filters.update', ['filter' => $filter]),
                $filter->toArray()
            )->assertStatus(302)
            ->assertRedirect(route('cms.filters.index'));
//        $filter->fresh();  // sometimes need
        $this->assertDatabaseHas('filters', [
            'name' => $name]);
        $this->assertEquals($filter->name, $name);
    }

    public function testFilterUpdateController()
    {
        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();
        $name = 'TEST_VALUE_CHANGES';
        $filter->name = $name;
        $this->actingAs($user)
            ->patch(route('cms.filters.update', ['filter' => $filter]),
                $filter->toArray()
            )->assertStatus(302)
            ->assertRedirect(route('cms.filters.index'));
$this->assertDatabaseHas('filters', [
            'name' => $name]);
    }


    public function testUpdateFilterWontUpdateWithoutDescription()
    {
        $user = UserGenerator::createAdminUser();
        $filter = FilterGenerator::createFilterAge();

        $filter['description'] = null;
        $this->actingAs($user)
            ->patch(route('cms.filters.update', ['filter' => $filter->id]),
                $filter->toArray()
            )->assertStatus(302)
            ->assertSessionHasErrors('description');

//        $filter->fresh();  // sometimes need
//        $this->assertEquals($filter->name, $name);
    }

    private function generateFilterCreateData(): array
    {
        return [
            'name' => 'Age 18-24',
            'value' => '18-24',
            'filter_type_id' => 1,
            'created_user_id' => 1,
            'description' => $this->faker->text(10)
        ];
    }


    private function createFilter(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.filters.store'), $data);
    }
}
