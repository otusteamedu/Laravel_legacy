<?php

namespace Tests\Feature;

use App\Http\Controllers\Subscriptions\MainController;
use App\Services\Subscriptions\SublistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class SublistControllerTest
 * @package Tests\Feature
 * @group cont
 */
class SublistControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testControllerExists()
    {
        $response = $this->get('/test');

        $response->assertStatus(200);
    }

    public function testDataWrite()
    {
        $email = 'admin@hp.ru';
        $this->from(route('test'))->post(route('write'), [
            'email' => $email
        ]);

        $sublist = app()->make(MainController::class);
        $data = $sublist->checkWrite();

        $this->assertEquals($email,$data);
    }
}
