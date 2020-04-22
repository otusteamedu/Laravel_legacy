<?php

namespace Tests\Feature\Cms;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\Generators\CountryGenerator;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * @param array $data
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function createCountry(array $data)
    {
        $user = UserGenerator::createAdminUser();

        return $this->actingAs($user)
            ->post(route('cms.countries.store'), $data);
    }
}
