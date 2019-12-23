<?php

namespace Tests\Feature\Controllers;

use App\Models\Location;
use App\Models\Workout;
use App\Models\User;
use App\Services\Workout\WorkoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;

class WorkoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Default values for Workout
     */
    const DEFAULT_DATA = [
        'name' => 'Test Workout',
        'distance' => 10000,
        'started_at' => '2019-01-01 00:00:00',
        'duration' => 200,
    ];

    /**
     * @var WorkoutService $workoutService
     */
    private $workoutService;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->workoutService = $this->app->make('App\Services\Workout\WorkoutService');
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
     * Create Location instance.
     *
     * @param  User  $user
     * @param  array  $data
     * @return TestResponse
     */
    private function createLocation(User $user): Location
    {
        return factory(Location::class)->create(['user_id' => $user->id]);
    }

    /**
     * Create a Workout via POST request.
     *
     * @param  User  $user
     * @param  array  $data
     * @return TestResponse
     */
    private function createWorkout(User $user, array $data): TestResponse
    {
        return $this
            ->actingAs($user)
            ->post(route('backend.workout.store'), $data);
    }

    /**
     * Update a Workout via PUT request.
     *
     * @param  User  $user
     * @param  Workout  $workout
     * @param  array  $data
     * @return TestResponse
     */
    private function updateWorkout(User $user, Workout $workout, array $data): TestResponse
    {
        return $this
            ->actingAs($user)
            ->put(route('backend.workout.update', $workout->id), $data);
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
     * Data Provider: invalid date.
     *
     * @return array
     */
    public function invalidStartAtProvider()
    {
        return [
            ['qwerty'],
            [date('Y-m-d', strtotime('tomorrow'))],
        ];
    }

    /**
     * Data Provider: invalid duration.
     *
     * @return array
     */
    public function invalidDurationProvider()
    {
        return [
            ['qwerty'],
            [-100],
            [0],
            [1999999]
        ];
    }

    /**
     * Test 'backend.workout.index' route (not authorized).
     *
     * @return void
     */
    public function testIndexRouteNotAuthorized()
    {
        $response = $this->get(route('backend.workout.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.workout.index' route (authorized).
     *
     * @return void
     */
    public function testIndexRouteAuthorized()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('backend.workout.index'));
        $response->assertStatus(200);
        $response->assertSeeText('Workouts');
    }

    /**
     * Test 'backend.workout.create' route (not authorized).
     *
     * @return void
     */
    public function testCreateRouteNotAuthorized()
    {
        $response = $this->get(route('backend.workout.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.workout.create' route (authorized).
     *
     * @return void
     */
    public function testCreateRouteAuthorized()
    {
        $user = $this->createUser();
        $location = $this->createLocation($user); // Нужно для более полного code coverage
        $response = $this
            ->actingAs($user)
            ->get(route('backend.workout.create'));
        $response->assertStatus(200);
        $response->assertSeeText('Add new Workout');
    }

    /**
     * Test create form: empty name and distance.
     *
     * @return void
     */
    public function testCreateFormEmptyValues()
    {
        $user = $this->createUser();
        $data = [];
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasErrors([
            'name',
            'distance',
            'started_at',
            'duration',
        ]);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
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
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasErrors([
            'distance',
        ]);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
    }

    /**
     * Test create form: invalid started_at (out of range).
     *
     * @dataProvider invalidStartAtProvider
     * @return void
     */
    public function testCreateFormInvalidStartedAt($started_at)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $data['started_at'] = $started_at;
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasErrors([
            'started_at',
        ]);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
    }

    /**
     * Test create form: invalid duration (out of range).
     *
     * @dataProvider invalidDurationProvider
     * @return void
     */
    public function testCreateFormInvalidDuration($duration)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $data['duration'] = $duration;
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasErrors([
            'duration',
        ]);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
    }

    /**
     * Test create form: invalid location_id.
     *
     * @return void
     */
    public function testCreateFormInvalidLocationId()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $data['location_id'] = 100;
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasErrors([
            'location_id',
        ]);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
    }

    /**
     * Test create form (w/o Location).
     *
     * @return void
     */
    public function testCreateFormWithoutLocation()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertEquals(1, $this->workoutService->getByUser($user)->count());
    }

    /**
     * Test create form (with Location).
     *
     * @return void
     */
    public function testCreateFormWithLocation()
    {
        $user = $this->createUser();
        $location = $this->createLocation($user);

        $data = self::DEFAULT_DATA;
        $data['location_id'] = $location->id;

        $response = $this->createWorkout($user, $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $this->assertEquals(1, $this->workoutService->getByUser($user)->count());

        $workout = $this->workoutService->getByUser($user)->first();
        $this->assertEquals($location->id, $workout->location_id);
    }


    /**
     * Test 'backend.workout.edit' route (not authorized).
     *
     * @return void
     */
    public function testEditRouteNotAuthorized()
    {
        $response = $this->get(route('backend.workout.edit', 1));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.workout.edit' route (authorized, wrong ID).
     *
     * @return void
     */
    public function testEditRouteAuthorizedWrongId()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->get(route('backend.workout.edit', 100));
        $response->assertStatus(404);
    }

    /**
     * Test 'backend.workout.edit' route (authorized, correct ID).
     *
     * @return void
     */
    public function testEditRouteAuthorizedCorrectId()
    {
        $user = $this->createUser();
        $location = $this->createLocation($user); // Нужно для более полного code coverage
        $data = self::DEFAULT_DATA;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $response = $this
            ->actingAs($user)
            ->get(route('backend.workout.edit', $workout->id));
        $response->assertStatus(200);
        $response->assertSeeText('Edit Workout');
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
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data = [];
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasErrors([
            'name',
            'distance',
            'started_at',
            'duration',
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
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data['distance'] = $distance;
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasErrors([
            'distance',
        ]);
    }

    /**
     * Test create form: invalid started_at (out of range).
     *
     * @dataProvider invalidStartAtProvider
     * @return void
     */
    public function testEditFormInvalidStartedAt($started_at)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data['started_at'] = $started_at;
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasErrors([
            'started_at',
        ]);
    }

    /**
     * Test create form: invalid duration (out of range).
     *
     * @dataProvider invalidDurationProvider
     * @return void
     */
    public function testEditFormInvalidDuration($duration)
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data['duration'] = $duration;
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasErrors([
            'duration',
        ]);
    }

    /**
     * Test create form: invalid location_id.
     *
     * @return void
     */
    public function testEditFormInvalidLocationId()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data['location_id'] = 100;
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasErrors([
            'location_id',
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
        $location1 = $this->createLocation($user);
        $location2 = $this->createLocation($user);

        $data = self::DEFAULT_DATA;
        $data['location_id'] = $location1->id;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $data = [
            'name' => 'Test Workout 2',
            'distance' => 20000,
            'started_at' => '2019-02-01 00:00:00',
            'duration' => 300,
            'location_id' => $location2->id,
        ];
        $response = $this->updateWorkout($user, $workout, $data);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $workout = $this->workoutService->findById($workout->id);

        $this->assertEquals($data['name'], $workout->name);
        $this->assertEquals($data['distance'], $workout->distance);
        $this->assertEquals($data['started_at'], $workout->started_at);
        $this->assertEquals($data['duration'], $workout->duration);
        $this->assertEquals($data['location_id'], $workout->location_id);
    }

    /**
     * Test 'backend.workout.destroy' route (not authorized).
     *
     * @return void
     */
    public function testDestroyRouteNotAuthorized()
    {
        $response = $this->delete(route('backend.workout.destroy', 1));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Test 'backend.workout.destroy' route (authorized, wrong ID).
     *
     * @return void
     */
    public function testDestroyRouteAuthorizedWrongId()
    {
        $user = $this->createUser();
        $response = $this
            ->actingAs($user)
            ->delete(route('backend.workout.destroy', 100));
        $response->assertStatus(404);
    }

    /**
     * Test 'backend.workout.destroy' route (authorized, correct ID).
     *
     * @return void
     */
    public function testDestroyRouteAuthorizedCorrectId()
    {
        $user = $this->createUser();
        $data = self::DEFAULT_DATA;
        $this->createWorkout($user, $data);

        $workout = $this->workoutService->getByUser($user)->first();

        $response = $this
            ->actingAs($user)
            ->delete(route('backend.workout.destroy', $workout->id));
        $response->assertStatus(302);
        $this->assertEquals(0, $this->workoutService->getByUser($user)->count());
    }


}
