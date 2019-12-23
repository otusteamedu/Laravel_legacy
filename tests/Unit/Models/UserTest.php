<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test relation: Locations.
     *
     * @return void
     */
    public function testRelationLocations()
    {
        $user = factory(User::class)->make();
        $location = factory(Location::class)->make([
            'user_id' => $user->id,
        ]);
        $this->assertInstanceOf(HasMany::class, $user->locations());
        $this->assertInstanceOf(Location::class, $user->locations()->getRelated());
        $this->assertEquals('locations.user_id', $user->locations()->getQualifiedForeignKeyName());
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
        $this->assertInstanceOf(HasMany::class, $user->workouts());
        $this->assertInstanceOf(Workout::class, $user->workouts()->getRelated());
        $this->assertEquals('workouts.user_id', $user->workouts()->getQualifiedForeignKeyName());
    }

    /**
     * Test relation: Roles.
     *
     * @return void
     */
    public function testRelationRoles()
    {
        $user = factory(User::class)->make();
        $role = factory(Role::class)->make();
        $roleUser = factory(RoleUser::class)->make([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
        $this->assertInstanceOf(BelongsToMany::class, $user->roles());
        $this->assertInstanceOf(Role::class, $user->roles()->getRelated());
        $this->assertEquals('role_user.user_id', $user->roles()->getQualifiedForeignPivotKeyName());
    }

}
