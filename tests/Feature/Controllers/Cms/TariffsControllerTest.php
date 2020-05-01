<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\Tariff;
use App\Services\Tariffs\Repositories\TariffRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\TariffGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class TariffsControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getTariffRepository(): TariffRepositoryInterface
    {
        return app()->make(TariffRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group tariffs
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.tariffs.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group tariffs
     * @group testIndexWithTariffs
     */
    public function testIndexWithTariffs()
    {
        $tariff = TariffGenerator::createTariff();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.tariffs.index'))
            ->assertStatus(200)
            ->assertSeeText($tariff->name);
    }

    /**
     * @group cms
     * @group tariffs
     * @group testUnAuthicatedUserWontCreateTariffAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateTariffAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateTariffCreateData();
        $this->post(route('cms.tariffs.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group tariffs
     * @group testCreateTariff
     * @return void
     */
    public function testCreateTariff()
    {
        $data = $this->generateTariffCreateData();
        $this->createTariff($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('tariffs', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(Tariff::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group tariffs
     * @group testCreateTariffFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateTariffFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.tariffs.store'), [
                'condition' => $this->faker->text,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Tariff::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group tariffs
     * @group testCreateTariffFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateTariffFailsIfParamsAreEmpty()
    {
        $this->createTariff([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Tariff::all()->count());
    }

    /**
     * @return array
     */
    private function generateTariffCreateData(): array
    {
        return [
            'name' => $this->faker->text(20),
            'condition' => $this->faker->text,
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createTariff(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.tariffs.store'), $data);
    }

}
