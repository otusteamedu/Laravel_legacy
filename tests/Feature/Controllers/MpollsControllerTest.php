<?php

namespace Tests\Feature\Controllers;

use App\Models\Mpoll;
use App\Services\Mpolls\Repositories\MpollRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\MpollGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class MpollsControllerTest extends TestCase
{
    // RefreshDatabase Перенакатывает все миграции
    use RefreshDatabase;
    use WithFaker;

    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.mpolls.index'))
            ->assertStatus(200);
    }

    public function testIndexWithMpolls()
    {
        //Show real Exceptions
        $this->withoutExceptionHandling();
        $mpoll = $this->generateMpollCreateData();
        $this->createMpoll($mpoll)
            ->assertStatus(302);
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.mpolls.index'))
            ->assertStatus(200)
            ->assertSeeText($mpoll['name']);

        $this->assertDatabaseHas('mpolls', [
            'name' => $mpoll['name']]);
    }

    public function testDeleteExistingMpoll()
    {
        //Show real Exceptions
        $this->withoutExceptionHandling();
        $user = UserGenerator::createAdminUser();
        $mpoll = MpollGenerator::createMpoll();
        $this->assertCount(1, Mpoll::all());

        $this->actingAs($user)->from(route('cms.mpolls.index'))
            ->delete(route('cms.mpolls.destroy', $mpoll))
            ->assertStatus(302);
//            ->assertRedirect(route('cms.mpolls.index'));

        $this->assertCount(0, Mpoll::all());

    }

    public function testUnAuthUserWontCreateMpollAndRedirectOnLogin()
    {
        $mpoll = $this->generateMpollCreateData();
        $this->post(route('cms.filters.store'), $mpoll)
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    public function testWontCreateMpollWithoutDescription()
    {
        $user = UserGenerator::createAdminUser();
        $mpoll =$mpoll = $this->generateMpollCreateData();
        $mpoll['name'] = 'Test_Value';
        unset($mpoll['description']);
        $this->actingAs($user)
            ->post(route('cms.filters.store'), $mpoll)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'description'
            ]);
//            ->assertRedirect(route('cms.filters.edit', $data));
        // Проверяем, что такой записи нет
        $this->assertDatabaseMissing('filters', [
            'name' => $mpoll['name']
        ]);
    }
    public function testCreateMpoll()
    {
        $data = $this->generateMpollCreateData();
        $this->createMpoll($data)
            ->assertStatus(302);
//Check , DB creates record
        $this->assertDatabaseHas('mpolls', [
            'name' => $data['name']
        ]);
        //Check that Mpoll name exists
        $this->assertNotNull(Mpoll::where('name', $data['name'])->first());

    }

    public function testCreateMpollStoresOnlyOneMpoll()
    {
        $data = $this->generateMpollCreateData();
        $this->createMpoll($data)
            ->assertStatus(302);
        $this->assertEquals(1, Mpoll::all()->count());
    }

    public function testUserOpenCreateForm()
    {
        //Show real Exceptions
//        $this->withoutExceptionHandling();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.mpolls.create'))
            ->assertSeeText('Delete Quota')
            ->assertOk();

    }

    public function testUserOpenEditForm()
    {
        //Show real Exceptions
//        $this->withoutExceptionHandling();
        $mpoll = MpollGenerator::createMpoll(['name' => 'Test Name']);
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.mpolls.edit', $mpoll))
            ->assertSee('Test Name')
            ->assertSee('Add Quota')
            ->assertOk();
    }

    public function testUserOpenEditFormWithNotExistingId()
    {
        $mpoll = MpollGenerator::createMpoll();
        $mpoll->id = rand(10, 100);
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)->get(route('cms.mpolls.edit', 20))
            ->assertStatus(404);
    }

    public function testUpdateMpoll()
    {
        $user = UserGenerator::createAdminUser();
        $mpoll = MpollGenerator::createMpoll();

        $repository = $this->getMpollRepository();
        $repository->updateFromArray($mpoll, ['name' => 'TEST_VALUE']);
        $this->assertDatabaseHas('mpolls', [
            'name' => 'TEST_VALUE']);

        $name = 'TEST_VALUE_CHANGES';
        $mpoll['name'] = $name;
        $this->actingAs($user)->from(route('cms.mpolls.update', ['mpoll' => $mpoll]))
            ->patch(route('cms.mpolls.update', ['mpoll' => $mpoll]),
                $mpoll->toArray()
            )->assertStatus(302)
            ->assertRedirect(route('cms.mpolls.edit', ['mpoll' => $mpoll]));
        $this->assertDatabaseHas('mpolls', [
            'name' => $name]);
        $this->assertEquals($mpoll->name, $name);
    }

    public function testMpollUpdateController()
    {
        $user = UserGenerator::createAdminUser();
        $mpoll = MpollGenerator::createMpoll();
        $name = 'TEST_VALUE_CHANGES';
        $mpoll->name = $name;
        $this->actingAs($user)
            ->patch(route('cms.mpolls.update', ['mpoll' => $mpoll]),
                $mpoll->toArray()
            )->assertStatus(302)
            ->assertRedirect(route('cms.mpolls.edit', $mpoll));
        $this->assertDatabaseHas('mpolls', [
            'name' => $name]);
    }

    public function testUpdateMpollWontUpdateWithoutDescription()
    {
        $user = UserGenerator::createAdminUser();
        $mpoll = MpollGenerator::createMpoll();

        $mpoll['description'] = null;
        $this->actingAs($user)
            ->patch(route('cms.mpolls.update', ['mpoll' => $mpoll->id]),
                $mpoll->toArray()
            )->assertStatus(302)
            ->assertSessionHasErrors('description');
    }

    ## PRIVATE

    private function getMpollRepository(): MpollRepositoryInterface
    {
        return app()->make(MpollRepositoryInterface::class);
    }

    private function generateMpollCreateData(): array
    {
        return [
            'name' => 'Survey Generated ' . rand(1, 200),
            'mstatus_id' => 1,
            'mtype_id' => 5,
            'starttime' => NULL,
            'endtime' => NULL,
            'price' => '0.60',
            'description' => 'Survey for £0.' . rand(1, 9),
            'click' => rand(2, 5000),
            'repeatable' => 1,
            'country_id' => 21,
            'length' => '',
            'survlimit' => NULL,
            'prescreener' => '',
            'singleLink' => $this->faker->url() . '?sub=[SUB]',
//            'singleLink' => 'http://www.your-surveys.com/?si=488&ssi=[SUB]',
            'filename' => '',
            'key' => NULL,
            'incabinet' => 1,
            'cab_link' => 'https://link.luxsurveys.com/mpolls/poll/XXX',
            'cab_price' => '0.6£',
            'completes' => rand(2, 5000),
            'overquotas' => rand(2, 5000),
            'screenout' => 0,
            'mail_id' => 32,
            'check_geo' => rand(0, 1),
            'customer_id' => 8,
            'created_user_id' => 1,
        ];
    }


    private function createMpoll(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.mpolls.store'), $data);
    }


}
