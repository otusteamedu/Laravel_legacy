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

    public function testStatusRoute()
    {
        $user = UserGenerator::createUserAdminWithRole(['name' => 'test_user3', 'email' => 'admin@mail.ru']);
        $response = $this->actingAs($user)
            ->call('GET', route('admin.statuses.index'));
        $response->assertStatus(200);
    }


}

