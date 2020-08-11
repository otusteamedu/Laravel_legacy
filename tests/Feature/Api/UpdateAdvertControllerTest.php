<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class UpdateAdvertControllerTest extends TestCase
{
    /**
     * @group api
     */
    public function testUpdateReturn401IfNoUser()
    {

        $advert =  AdvertTestGenerator::generateAdvert();

        $data = ['title'=>'Test title'];

        $this->json('PATCH', route('api.adverts.update', ['advert' => $advert->id]), $data)
             ->assertStatus(401);
    }

    /**
     * @group api
     */
    public function testUpdate()
    {
        AdvertTestGenerator::createAndAuthUser();

        $advert =  AdvertTestGenerator::generateAdvert();

        $data = [
            'title' => 'Test title',
            'town_id' => $advert->town_id,
            'division_id' => $advert->division_id,
            'price' => $advert->price,
        ];

        $this->json('PATCH', route('api.adverts.update', ['advert' => $advert->id]), $data)
             ->assertStatus(200);

        $this->assertDatabaseHas('adverts',
            [
                'title' => $data['title'],
            ]);
    }


}
