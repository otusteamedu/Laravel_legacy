<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class destroyAdvertsControllerTest extends TestCase
{
    /**
     * @group api
     */
    public function testDestroyReturn401IfNoUser()
    {
       $advert =  AdvertTestGenerator::generateAdvert();

        $this->json('delete', route('api.adverts.destroy', ['advert' => $advert->id]))
             ->assertStatus(401);
    }
    /**
     * @group api
     */
    public function testDestroy()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $advert =  AdvertTestGenerator::generateAdvert();

        $this->json('delete', route('api.adverts.destroy', ['advert' => $advert->id]))
             ->assertStatus(200);

        $this->assertDatabaseMissing('adverts', ['id'=>$advert->id]);
    }

    /**
     * @group api
     */
    public function testDestroy404NotFound()
    {
        AdvertTestGenerator::makeAndAuthUser();

        $this->json('delete', route('api.adverts.destroy', ['advert' => 0]))
            ->assertStatus(404);
    }
}
