<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test relation: User.
     *
     * @return void
     */
    public function testRelationUser()
    {
        $user = factory(User::class)->make();
        $location = factory(Location::class)->make([
            'user_id' => $user->id,
        ]);
        $this->assertInstanceOf(BelongsTo::class, $location->user());
        $this->assertInstanceOf(User::class, $location->user()->getRelated());
        $this->assertEquals('locations.user_id', $location->user()->getQualifiedForeignKeyName());
    }

    /**
     * Test relation: Workouts.
     *
     * @return void
     */
    public function testRelationWorkouts()
    {
        $user = factory(User::class)->make();
        $location = factory(Location::class)->make([
            'user_id' => $user->id,
        ]);
        $workout = factory(Workout::class)->make([
            'user_id' => $user->id,
            'location_id' => $location->id,
        ]);
        $this->assertInstanceOf(HasMany::class, $location->workouts());
        $this->assertInstanceOf(Workout::class, $location->workouts()->getRelated());
        $this->assertEquals('workouts.location_id', $location->workouts()->getQualifiedForeignKeyName());
    }

}
