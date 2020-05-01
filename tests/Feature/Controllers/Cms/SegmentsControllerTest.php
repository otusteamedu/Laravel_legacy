<?php

namespace Tests\Feature\Controllers\Cms;

use App\Models\Segment;
use App\Services\Segments\Repositories\SegmentRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\SegmentGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class SegmentsControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function getSegmentRepository(): SegmentRepositoryInterface
    {
        return app()->make(SegmentRepositoryInterface::class);
    }

    /**
     * @group cms
     * @group segments
     * @group testIndex
     */
    public function testIndex()
    {
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.segments.index'))
            ->assertStatus(200);
    }

    /**
     * @group cms
     * @group segments
     * @group testIndexWithSegments
     */
    public function testIndexWithSegments()
    {
        $segment = SegmentGenerator::createMoscow();
        $user = UserGenerator::createAdminUser();
        $this->actingAs($user)
            ->get(route('cms.segments.index'))
            ->assertStatus(200)
            ->assertSeeText($segment->name);
    }

    /**
     * @group cms
     * @group segments
     * @group testUnAuthicatedUserWontCreateSegmentAndRedirectOnLogin
     */
    public function testUnAuthicatedUserWontCreateSegmentAndRedirectOnLogin()
    {
        \Mail::fake();
        $data = $this->generateSegmentCreateData();
        $this->post(route('cms.segments.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
        \Mail::assertNothingSent();
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group segments
     * @group testCreateSegment
     * @return void
     */
    public function testCreateSegment()
    {
        $data = $this->generateSegmentCreateData();
        $this->createSegment($data)
            ->assertStatus(200);

        $this->assertDatabaseHas('segments', [
            'name' => $data['name'],
        ]);
        $this->assertNotNull(Segment::where('name', $data['name'])->first());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group segments
     * @group testCreateSegmentFailsIfNameIsEmpty
     * @return void
     */
    public function testCreateSegmentFailsIfNameIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.segments.store'), [
                'country_id' => function(){
                    return factory(App\Models\Country::class)->create()->id;
                },
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Segment::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group segments
     * @group testCreateSegmentFailsIfNameIsEmpty
     * @return void
     */

    public function testCreateSegmentFailsIfCountryIdIsEmpty()
    {
        $user = UserGenerator::createAdminUser();

        $this->actingAs($user)
            ->post(route('cms.segments.store'), [
                'name' => $this->faker->segment,
            ])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Segment::all()->count());
    }

    /**
     * A Dusk test example.
     *
     * @group cms
     * @group segments
     * @group testCreateSegmentFailsIfParamsAreEmpty
     * @return void
     */
    public function testCreateSegmentFailsIfParamsAreEmpty()
    {
        $this->createSegment([])
            ->assertSessionHasErrors();

        $this->assertEquals(0, Segment::all()->count());
    }

    /**
     * @return array
     */
    private function generateSegmentCreateData(): array
    {
        return [
            'name' => $this->faker->segment,
            'country_id' => function(){
                return factory(App\Models\Country::class)->create()->id;
            }
        ];
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    private function createSegment(array $data)
    {
        $user = UserGenerator::createAdminUser();
        return $this->actingAs($user)
            ->post(route('cms.segments.store'), $data);
    }

}
