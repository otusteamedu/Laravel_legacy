<?php

namespace Tests\Unit\Services\Workout;

use App\Services\User\UserService;
use App\Services\Workout\WorkoutService;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkoutServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Default values for Workout
     */
    const DEFAULT_DATA_WORKOUT = [
        'name' => 'Test Workout',
        'distance' => 10000,
        'started_at' => '2019-01-01 00:00:00',
        'duration' => 200,
    ];

    /**
     * Default values for User
     */
    const DEFAULT_DATA_USER = [
        'name' => 'Test User',
        'email' => 'test@localhost',
        'password' => 'Str0ngPassw0rd',
    ];

    /**
     * @var WorkoutService $workoutService
     */
    private $workoutService;

    /**
     * @var UserService $userService
     */
    private $userService;

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->workoutService = $this->app->make('App\Services\Workout\WorkoutService');
        $this->userService = $this->app->make('App\Services\User\UserService');
    }

    /**
     * Test WorkoutService::getByUser() method.
     *
     * @return void
     */
    public function testGetByUser(): void {

        $data = self::DEFAULT_DATA_USER;
        $user = $this->userService->create($data);

        $data = self::DEFAULT_DATA_WORKOUT;
        $data['user_id'] = $user->id;
        $workout = $this->workoutService->create($data);

        $result = $this->workoutService->getByUser($user);
        $this->assertEquals(1, $result->count());
        $this->assertEquals($workout->id, $result->first()->id);
    }

    /**
     * Test WorkoutService::getByUserCached() method.
     *
     * @return void
     */
    public function testGetByUserCached(): void {

        Cache::flush();

        $data = self::DEFAULT_DATA_USER;
        $user = $this->userService->create($data);

        $data = self::DEFAULT_DATA_WORKOUT;
        $data['user_id'] = $user->id;
        $workout = $this->workoutService->create($data);

        $result = $this->workoutService->getByUserCached($user);
        $this->assertEquals(1, $result->count());
        $this->assertEquals($workout->id, $result->first()->id);
    }

}
