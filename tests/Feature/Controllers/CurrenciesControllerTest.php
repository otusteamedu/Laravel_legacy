<?php
/**
 * Тесты для контроллера валют
 */

namespace Tests\Feature\Controllers;


use App\Models\Currency;
use App\Models\User;
use App\Services\Currencies\Repositories\CurrencyRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\CurrencyGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class CurrenciesControllerTest extends TestCase
{
    //use DatabaseTransactions;
    use RefreshDatabase;
    use WithFaker;

    private function getCurrencyRepository(): CurrencyRepositoryInterface
    {
        return app()->make(CurrencyRepositoryInterface::class);
    }


    /**
     * @group cms
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.currencies.index'))
            ->assertStatus(200)
            ->assertSeeText('Валюты')
        ;
    }

    /**
     * @group cms
     */
    public function testIndexWithCurrencies()
    {
        $currency = CurrencyGenerator::createRub();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.currencies.index'))
            ->assertStatus(200)
            ->assertSeeText($currency->code);
        $this->assertDatabaseHas('currencies', [
                'code' => $currency->code,
            ]);
    }

    /**
     * @group cms
     */
    public function testSearchCurrencies()
    {
        $currency1 = CurrencyGenerator::createRub();
        $currency2 = CurrencyGenerator::createUsd();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->post(route('cms.currencies.index'), ['code' => $currency1->code])
            ->assertStatus(200)
            ->assertSeeText($currency1->code)
            ->assertDontSeeText($currency2->code)
            ;
    }

    /**
     * @group cms
     */
    public function testSearchCurrenciesNotFound()
    {
        $currency1 = CurrencyGenerator::createRub();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->post(route('cms.currencies.index'), ['code' => 'EUR'])
            ->assertStatus(200)
            ->assertDontSeeText($currency1->code)
        ;
    }

    /**
     * @group cms
     */
    public function testUnAuthicatedUserWontCreateCurrencyAndRedirectOnLogin()
    {
        $data = $this->generateCurrencyCreateData();
        $this->post(route('cms.currencies.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }


    /**
     * @group cms
     */
    public function testAllCurrency()
    {
        $currency1 = CurrencyGenerator::createRub();
        $currency2 = CurrencyGenerator::createUsd();
        $currencyRepository = $this->getCurrencyRepository();
        $currencies = $currencyRepository->all();
        $this->assertCount(2, $currencies);
    }

    /**
     * @group cms
     */
    public function testCreateCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCurrencyCreateData();
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('currencies', [
            'code' => $data['code'],
        ]);
    }

    /**
     * @group cms
     */
    public function testCreateCurrentDuplicate()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCurrencyCreateData();
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(200)
        ;
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'code',
            ]);
        ;
        $this->assertDatabaseHas('currencies', [
            'code' => $data['code'],
        ]);
    }

    /**
     * @group cms
     */
    public function testWontCreateCurrencyWithoutName()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCurrencyCreateData();
        $code = $data['code'];
        unset($data['code']);
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'code',
            ]);

        $this->assertDatabaseMissing('currencies', [
            'code' => $code,
        ]);
    }

    /**
     * @group cms
     */
    public function testUpdateCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCurrencyCreateData();
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('currencies', [
            'code' => $data['code'],
        ]);
        $currency = Currency::where('code', $data['code'])->get();
        $newData = $this->generateCurrencyCreateData();
        $newData['id'] = $currency[0]->id;

        $this->actingAs($user)
            ->post(route('cms.currencies.update'), $newData)
            ->assertStatus(200);
        $this->assertDatabaseHas('currencies', [
            'code' => $newData['code'],
        ]);
    }

    /**
     * @group cms
     */
    public function testDeleteCurrency()
    {
        $user = UserGenerator::createAdminUser();
        $data = $this->generateCurrencyCreateData();
        $this->actingAs($user)
            ->post(route('cms.currencies.store'), $data)
            ->assertStatus(200)
        ;
        $this->assertDatabaseHas('currencies', [
            'code' => $data['code'],
        ]);
        $currency = Currency::where('code', $data['code'])->get();
        $currencyId = $currency[0]->id;

        $this->actingAs($user)
            ->post(route('cms.currencies.delete'), ['id' => $currencyId])
            ->assertStatus(200);
        $this->assertDatabaseMissing('currencies', [
            'code' => $data['code'],
        ]);
    }

    /**
     * @return array
     */
    private function generateCurrencyCreateData(): array
    {
        return [
            'code' => $this->faker->currencyCode,
        ];
    }
}
