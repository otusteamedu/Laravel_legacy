<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Arr;
use Tests\TestCase;

class StoreAdvertControllerTest extends TestCase
{

    /**
     * @group api
     */
    public function testStoreReturn401IfNoUser()
    {
        $data = AdvertTestGenerator::getExampleData();

        $this->json('POST', route('api.adverts.store'), $data)
            ->assertStatus(401);

    }

    /**
     * @group api
     */
    public function testStore()
    {
        AdvertTestGenerator::createAndAuthUser();

        $data = AdvertTestGenerator::getExampleData();

        $this->json('POST', route('api.adverts.store'), $data)
             ->assertStatus(201);

        $this->assertDatabaseHas('adverts',
            [ 'title' => $data['title'] ]);
    }

    /**
     * @group api
     */
    public function testStoreReturnAdvert()
    {

        AdvertTestGenerator::createAndAuthUser();

        $data = AdvertTestGenerator::getExampleData();

        $this->json('POST', route('api.adverts.store'), $data)
             ->assertStatus(201)
             ->assertJsonFragment($data);
    }

    /**
     * @group api
     */
    public function testStoreReturn422IfNotTown()
    {
        AdvertTestGenerator::createAndAuthUser();

        $data = AdvertTestGenerator::getExampleData();
        $data = Arr::except($data, ['town_id',]);

        $this->json('POST', route('api.adverts.store'), $data)
            ->assertStatus(422);

    }

    /**
     * @group api
     */
    public function testStoreReturn422IfNotDivision()
    {

        AdvertTestGenerator::createAndAuthUser();

        $data = AdvertTestGenerator::getExampleData();
        $data = Arr::except($data, ['division_id',]);

        $this->json('POST', route('api.adverts.store'), $data)
            ->assertStatus(422);

    }

}
