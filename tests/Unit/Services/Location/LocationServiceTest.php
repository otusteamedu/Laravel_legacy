<?php

namespace Tests\Unit\Services\Location;

use App\Services\User\UserService;
use App\Services\Location\LocationService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Default values for Location
     */
    const DEFAULT_DATA_LOCATION = [
        'name' => 'Test Location',
        'distance' => 10000,
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
     * @var LocationService $locationService
     */
    private $locationService;

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
        $this->locationService = $this->app->make('App\Services\Location\LocationService');
        $this->userService = $this->app->make('App\Services\User\UserService');
    }

    /**
     * Test LocationService::getByUser() method.
     *
     * @return void
     */
    public function testGetByUser(): void {

        $data = self::DEFAULT_DATA_USER;
        $user = $this->userService->create($data);

        $data = self::DEFAULT_DATA_LOCATION;
        $data['user_id'] = $user->id;
        $location = $this->locationService->create($data);

        $result = $this->locationService->getByUser($user);
        $this->assertEquals(1, $result->count());
        $this->assertEquals($location->id, $result->first()->id);
    }

    /**
     * Test LocationService::getByUserCached() method.
     *
     * @return void
     */
    public function testGetByUserCached(): void {

        Cache::flush();

        $data = self::DEFAULT_DATA_USER;
        $user = $this->userService->create($data);

        $data = self::DEFAULT_DATA_LOCATION;
        $data['user_id'] = $user->id;
        $location = $this->locationService->create($data);

        $result = $this->locationService->getByUserCached($user);
        $this->assertEquals(1, $result->count());
        $this->assertEquals($location->id, $result->first()->id);
    }

    /**
     * Test WorkoutService::clearSearchCache() method.
     *
     * @return void
     * @throws \Exception
     */
    public function testClearSearchCache(): void {

        Cache::flush();
        $newName = 'Test Location 2';

        $data = self::DEFAULT_DATA_USER;
        $user = $this->userService->create($data);

        $data = self::DEFAULT_DATA_LOCATION;
        $data['user_id'] = $user->id;
        $location = $this->locationService->create($data);

        $result = $this->locationService->getByUserCached($user);
        $this->assertEquals(1, $result->count());
        $this->assertEquals($location->id, $result->first()->id);

        // Update name in database (directly)
        DB::table('locations')
            ->where('id', $location->id)
            ->update(['name' => $newName]);
        // Old name is still cached
        $result = $this->locationService->getByUserCached($user);
        $this->assertEquals(self::DEFAULT_DATA_LOCATION['name'], $result->first()->name);

        // Clear cache and verify name
        $this->locationService->clearSearchCache(['user_id' => $user->id]);
        $result = $this->locationService->getByUserCached($user);
        $this->assertEquals($newName, $result->first()->name);

    }

}
