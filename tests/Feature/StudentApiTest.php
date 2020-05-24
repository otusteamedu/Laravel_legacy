<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\Generators\StudentGenerator;
use Tests\Generators\UserGenerator;

/**
 * Class StudentApiTest
 * @group api
 * @package Tests\Feature
 */
class StudentApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     * @group api
     * @return void
     */
    public function testList()
    {
        StudentGenerator::createStudent();
        $user = UserGenerator::createAdminUser();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('students.index')
        )->assertStatus(200);
        $response->assertJsonCount(2);
    }

    /**
     * @group api
     */
    public function testList401IfUnauthicated()
    {
        StudentGenerator::createStudent();

        $this->json(
            'GET',
            route('students.index')
        )->assertStatus(401);
    }

    /**
     * @group api
     */
    public function testStore()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;

        $this->json(
            'POST',
            route('students.store'),
            [
                'name' => $name,
            ]
        )->assertStatus(200);

        $this->assertDatabaseHas('students', [
            'name' => $name,
        ]);
    }

    /**
     * @group api
     */
    public function testCantCreateStudentWithoutName()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;

        $this->json(
            'POST',
            route('students.store'),
            []
        )->assertStatus(422);

        $this->assertDatabaseMissing('students', [
            'name' => $name,
        ]);
    }


    /**
     * @group api
     */
    public function testShow()
    {
        $student = StudentGenerator::createStudent();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('students.show', [
                'id' => $student->id
            ])
        )->assertStatus(200);

        $response->json($student->toArray());
    }

    /**
     * @group api
     */
    public function test404IfModelNotFound()
    {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'GET',
            route('students.show', [
                'id' => '34523264',
            ]))->assertStatus(404);
    }

    /**
     * @group api
     */
    public function testUpdate()
    {
        $spiderMan = StudentGenerator::createStudentSpiderMan();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;
        $response = $this->json(
            'PUT',
            route('students.update', [
                'id' => $spiderMan->id,
            ]), [
            'name' => $name,
        ])->assertStatus(200);

        $data = $spiderMan->toArray();
        $data['name'] = $name;
        $response->assertJson([
            'id' => $spiderMan->id,
            'name' => $name,
        ]);
    }


    /**
     * @group api
     */
    public function testDelete()
    {
        $student = StudentGenerator::createStudentSpiderMan();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'DELETE',
            route('students.destroy', [
                'id' => $student->id,
            ])
        )->assertStatus(200);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }


}
