<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\Offer;
use App\Services\Offers\Repositories\OfferRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\OfferGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class OffersControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getOfferRepository(): OfferRepositoryInterface
    {
        return app()->make(OfferRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group offers
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.offers.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group offers
     * @group testIndexWithOffers
     */
    public function testIndexWithOffers()
    {
        $offer = OfferGenerator::createOffer();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.offers.index'))
            ->assertStatus(200)
            ->assertSeeText($offer->name);
    }

    /**
     * @group cms
     * @group offers
     * @group testUnAuthicatedUserWontCreateOfferAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateOfferAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateOfferCreateData();
        $this->post(route('cms.offers.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group offers
     * @group testCreateOffer
     * @return void
     */
    public function testCreateOffer()
    {
        $data = $this->generateOfferCreateData();
        $this->createOffer($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('offers', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(Offer::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group offers
     * @group testCreateOfferFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateOfferFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.offers.store'), [
                'condition' => $this->faker->text,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Offer::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group offers
     * @group testCreateOfferFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateOfferFailsIfParamsAreEmpty()
    {
        $this->createOffer([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Offer::all()->count());
    }

    /**
     * @return array
     */
    private function generateOfferCreateData(): array
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
    private function createOffer(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.offers.store'), $data);
    }

}
