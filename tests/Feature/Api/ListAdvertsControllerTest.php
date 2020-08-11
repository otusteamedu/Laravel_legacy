<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ListAdvertsControllerTest extends TestCase
{
    /**
     * @group api
     */
    public function testListReturn401IfNoUser()
    {
        $this->json('get', route('api.adverts.index'))
             ->assertStatus(401);
    }
    /**
     * @group api
     */
    public function testList()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $this->json('get', route('api.adverts.index'))
             ->assertStatus(200);
    }

    /**
     * @group api
     * @group 1
     */
    public function testListLimitOffset()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $this->json('get', route('api.adverts.index',
                                          ['limit'=>1,'offset'=>1]) )
                ->assertStatus(200)
                ->assertJsonCount(1);

    }
}
