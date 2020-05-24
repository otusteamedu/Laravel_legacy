<?php

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User as User;
use Tests\Generators\UserGenerator;


class StudentControllerTest extends TestCase
{
//    use WithoutMiddleware;
//    use RefreshDatabase;
    use WithFaker;


    /**
     * @group Student
     */
    public function testUnauthUserWontCreateStudent()
    {

        $user = UserGenerator::createUser();

        $data = $this->generateStudentCreateData();
        $data['created_by'] = '20';

        $this->actingAs($user)->post(route('admin.student.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('login'));


    }

    public function generateStudentCreateData()
    {
        return [
            'name' => $this->faker->name(),
            'created_by' => 1,
        ];
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }
}
