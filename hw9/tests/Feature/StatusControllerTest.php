<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use App\Models\Status;
use Tests\Generators\UserGenerator;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testStatusRoute()
    {
        $data['name'] = 'test_user3';
        $data['email'] = 'test_user3@test.ru';
        $user = UserGenerator::createUserAdmin($data);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.statuses.index'));
        $response->assertStatus(200);
    }


}

