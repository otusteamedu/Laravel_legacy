<?php

namespace Tests\Feature\Console\Commands;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WarmupCacheTest extends TestCase
{
    use RefreshDatabase;

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
     * Test Artisan cache:warmup command.
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

    /**
     * Test Artisan cache:warmup command (no users).
     *
     * @return void
     */
    public function testWarmupCacheNoUsers()
    {
        $this->artisan('cache:warmup')
            ->expectsOutput('No users found')
            ->assertExitCode(0);
    }

}
