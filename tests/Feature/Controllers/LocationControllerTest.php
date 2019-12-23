<?php

namespace Tests\Feature\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Services\Location\LocationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Default values for Location
     */
    const DEFAULT_DATA = [
        'name' => 'Test Location',
        'distance' => 10000,
    ];

    /**
     * @var LocationService $locationService
     */
    private $locationService;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->locationService = $this->app->make('App\Services\Location\LocationService');
    }

    /**
     * Create User instance.
     *
     * @return User
     */
    private function createUser(): User
    {
        return factory(User::class)->create();
    }

    /**
     * Create a Location via POST request.
     *
     * @param  User  $user
     * @param  array  $data
     * @return TestResponse
     */
    private function createLocation(User $user, array $data): TestResponse
    {
        return $this
            ->actingAs($user)
            ->post(route('backend.location.store'), $data);
    }

    /**
     * Update a Location via PUT request.
     *
     * @param  User  $user
     * @param  Location  $location
     * @param  array  $data
     * @return TestResponse
     */
    private function updateLocation(User $user, Location $location, array $data): TestResponse
    {
        return $this
            ->actingAs($user)
            ->put(route('backend.location.update', $location->id), $data);
    }

    /**
     * Data Provider: invalid distance.
     *
     * @return array
     */
    public function invalidDistanceProvider()
    {
        return [
            ['qwerty'],
            [-100],
            [0],
            [1999999]
        ];
    }

    /**
     * Test 'backend.location.index' route (not authorized).
     *
     * @return void
     */
    public function testIndexRouteNotAuthorized()
    {
        $response = $this->get(route('backend.location.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.location.index' route (authorized).
     *
     * @return void
     */
    public function testIndexRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('backend.location.index'));
        $response->assertStatus(200);
        $response->assertSeeText('Locations');
    }

    /**
     * Test 'backend.location.create' route (not authorized).
     *
     * @return void
     */
    public function testCreateRouteNotAuthorized()
    {
        $response = $this->get(route('backend.location.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.location.create' route (authorized).
     *
     * @return void
     */
    public function testCreateRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('backend.location.create'));
        $response->assertStatus(200);
        $response->assertSeeText('Add new Location');
    }

    /**
     * Test create form: empty values.
     *
     * @return void
     */
    public function testCreateFormEmptyValues()
    {
        $user = $this->createUser();
        $data = [];
        $response = $this->createLocation($user, $data);
        $response->assertSessionHasErrors([
            'name',
            'distance',
        ]);
        $this->assertEquals(0, $this->locationService->getByUser($user)->count());
    }

    /**
     * Test create form: invalid distance (out of range).
     *
     * @dataProvider invalidDistanceProvider
     * @return void
     */
    public function testCreateFormInvalidDistance($distance)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $data['distance'] = $distance;
        $response = $this->createLocation($user, $data);
        $response->assertSessionHasErrors([
            'distance',
        ]);
        $this->assertEquals(0, $this->locationService->getByUser($user)->count());
    }

    /**
     * Test create form.
     *
     * @return void
     */
    public function testCreateForm()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $response = $this->createLocation($user, $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertEquals(1, $this->locationService->getByUser($user)->count());
    }

    /**
     * Test 'backend.location.edit' route (not authorized).
     *
     * @return void
     */
    public function testEditRouteNotAuthorized()
    {
        $response = $this->get(route('backend.location.edit', 1));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.location.edit' route (authorized, wrong ID).
     *
     * @return void
     */
    public function testEditRouteAuthorizedWrongId()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('backend.location.edit', 100));
        $response->assertStatus(404);
    }

    /**
     * Test 'backend.location.edit' route (authorized, correct ID).
     *
     * @return void
     */
    public function testEditRouteAuthorizedCorrectId()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createLocation($user, $data);

        $location = $this->locationService->getByUser($user)->first();

        $response = $this
            ->actingAs($user)
            ->get(route('backend.location.edit', $location->id));
        $response->assertStatus(200);
        $response->assertSeeText('Edit Location');
    }

    /**
     * Test edit form: empty values.
     *
     * @return void
     */
    public function testEditFormEmptyValues()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createLocation($user, $data);

        $location = $this->locationService->getByUser($user)->first();

        $data = [];
        $response = $this->updateLocation($user, $location, $data);
        $response->assertSessionHasErrors([
            'name',
            'distance',
        ]);
    }

    /**
     * Test edit form: invalid distance (out of range).
     *
     * @dataProvider invalidDistanceProvider
     * @return void
     */
    public function testEditFormInvalidDistance($distance)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createLocation($user, $data);

        $location = $this->locationService->getByUser($user)->first();

        $data['distance'] = $distance;
        $response = $this->updateLocation($user, $location, $data);
        $response->assertSessionHasErrors([
            'distance',
        ]);
    }

    /**
     * Test edit form.
     *
     * @return void
     */
    public function testEditForm()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createLocation($user, $data);

        $location = $this->locationService->getByUser($user)->first();

        $data = [
            'name' => 'Test Location 2',
            'distance' => 20000,
        ];
        $response = $this->updateLocation($user, $location, $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $location = $this->locationService->findById($location->id);

        $this->assertEquals($data['name'], $location->name);
        $this->assertEquals($data['distance'], $location->distance);
    }

    /**
     * Test 'backend.location.destroy' route (not authorized).
     *
     * @return void
     */
    public function testDestroyRouteNotAuthorized()
    {
        $response = $this->delete(route('backend.location.destroy', 1));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.location.destroy' route (authorized, wrong ID).
     *
     * @return void
     */
    public function testDestroyRouteAuthorizedWrongId()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->delete(route('backend.location.destroy', 100));
        $response->assertStatus(404);
    }

    /**
     * Test 'backend.location.destroy' route (authorized, correct ID).
     *
     * @return void
     */
    public function testDestroyRouteAuthorizedCorrectId()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createLocation($user, $data);

        $location = $this->locationService->getByUser($user)->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('backend.location.destroy', $location->id));
        $response->assertStatus(302);
        $this->assertEquals(0, $this->locationService->getByUser($user)->count());
    }


}
