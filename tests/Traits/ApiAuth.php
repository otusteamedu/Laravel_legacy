<?php

namespace Tests\Traits;

use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\Generators\UserGenerator;

/**
 * Trait Auth
 * @package Tests\Traits
 */
trait ApiAuth
{
    public function authByMethodist(): void
    {
        $user = UserGenerator::generateMethodist();
        Passport::actingAs($user, ['userinfo', 'messages']);
    }

    public function testGet401IfNoUser(): void
    {
        $this->json($this->getMethod(), $this->getUri())
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testGet403IfNoScopeUserinfo(): void
    {
        $user = UserGenerator::generateMethodist();
        Passport::actingAs($user, ['messages']);

        $this->json($this->getMethod(), $this->getUri())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGet403IfNoScopeMessages(): void
    {
        $user = UserGenerator::generateMethodist();
        Passport::actingAs($user, ['userinfo']);

        $this->json($this->getMethod(), $this->getUri())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function testGet403ForStudent(): void
    {
        $user = UserGenerator::generateStudent();
        Passport::actingAs($user, ['userinfo', 'messages']);

        $this->json($this->getMethod(), $this->getUri())
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
