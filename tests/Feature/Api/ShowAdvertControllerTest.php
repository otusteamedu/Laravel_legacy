<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowAdvertsControllerTest extends TestCase
{
    /**
     * @group api
     */
    public function testListReturn401IfNoUser()
    {
        $this->json('get', route('api.adverts.show', ['advert' => 2 ]))
             ->assertStatus(401);
    }
    /**
     * @group api
     */
    public function testList()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $this->json('get', route('api.adverts.show', ['advert' => 2 ]))
             ->assertStatus(200);
    }

    /**
     * @group api
     */
    public function testList404NotFound()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $this->json('get', route('api.adverts.show', ['advert' => 0 ]))
             ->assertStatus(404);
    }

}
