<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkoutTest extends TestCase
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
        $workout = factory(Workout::class)->make([
            'user_id' => $user->id,
            'location_id' => $location->id,
        ]);
        $this->assertInstanceOf(BelongsTo::class, $workout->user());
        $this->assertInstanceOf(User::class, $workout->user()->getRelated());
        $this->assertEquals('workouts.user_id', $workout->user()->getQualifiedForeignKeyName());
    }

    /**
     * Test relation: Location.
     *
     * @return void
     */
    public function testRelationLocation()
    {
        $user = factory(User::class)->make();
        $location = factory(Location::class)->make([
            'user_id' => $user->id,
        ]);
        $workout = factory(Workout::class)->make([
            'user_id' => $user->id,
            'location_id' => $location->id,
        ]);
        $this->assertInstanceOf(BelongsTo::class, $workout->location());
        $this->assertInstanceOf(Location::class, $workout->location()->getRelated());
        $this->assertEquals('workouts.location_id', $workout->location()->getQualifiedForeignKeyName());
    }

}
