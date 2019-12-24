<?php

namespace Tests\Feature\Console\Commands;

use App\Models\User;
use Tests\TestCase;

class WarmupCacheTest extends TestCase
{
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
     * A basic test example.
     *
     * @return void
     */
    public function testWarmupCache()
    {
        $user = $this->createUser();

        $this->artisan('cache:warmup')
            ->expectsOutput('Warmed up cache for '.$user->name)
            ->assertExitCode(0);
    }
}
