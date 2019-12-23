<?php

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Workout;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test relation: Users.
     *
     * @return void
     */
    public function testRelationUsers()
    {
        $user = factory(User::class)->make();
        $role = factory(Role::class)->make();
        $roleUser = factory(RoleUser::class)->make([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
        $this->assertInstanceOf(BelongsToMany::class, $role->users());
        $this->assertInstanceOf(User::class, $role->users()->getRelated());
        $this->assertEquals('role_user.role_id', $role->users()->getQualifiedForeignPivotKeyName());
    }

}
