<?php

namespace Tests\Feature\Controllers\Api\Authors;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\Generators\AuthorGenerator;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AuthorControllerTest extends TestCase {

    use RefreshDatabase, WithFaker;

    /**
     * @group api
     * @group authors_api
     */
    public function testList() {
        AuthorGenerator::createUncleBob();
        AuthorGenerator::createMax();

        $user = UserGenerator::createAdminUser();

        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('authors.index')
        )
            ->assertStatus(200);
        $response->assertJsonCount(2);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testListWillReturn401IfUnauthicated() {
        AuthorGenerator::createUncleBob();
        AuthorGenerator::createMax();

        $this->json(
            'GET',
            route('authors.index')
        )
            ->assertStatus(401);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testStore() {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;
        $surname = $this->faker->lastName;

        $this->json(
            'POST',
            route('authors.store'),
            [
                'name' => $name,
                'surname' => $surname,
            ]
        )->assertStatus(200);

        $this->assertDatabaseHas('authors', [
            'name' => $name,
        ]);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testStoreWontCreateCountryWithoutName() {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $name = $this->faker->name;

        $this->json(
            'POST',
            route('authors.store'),
            [
                'surname' => 'Tolstoy',
            ]
        )->assertStatus(422);

        $this->assertDatabaseMissing('authors', [
            'name' => $name,
        ]);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testShow() {
        $uncleBob = AuthorGenerator::createUncleBob();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $response = $this->json(
            'GET',
            route('authors.show', [
                'author' => $uncleBob->id
            ])
        )->assertStatus(200);

        $response->json($uncleBob->toArray());
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testShowWillReturn404IfModelNotFound() {
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'GET',
            route('authors.show', [
                'author' => '777777777777',
            ]))->assertStatus(404);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testUpdate() {
        $maxFolder = AuthorGenerator::createMax();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $surname = $this->faker->lastName;
        $response = $this->json(
            'PUT',
            route('authors.update', [
                'author' => $maxFolder->id,
            ]), [
            'surname' => $surname,
        ])
            ->assertStatus(200);

        $data = $maxFolder->toArray();
        $data['surname'] = $surname;
        $response->assertJson([
            'name' => $maxFolder->name,
            'surname' => $surname,
        ]);
    }

    /**
     * @group api
     * @group authors_api
     */
    public function testDeleteWontDelete() {
        $uncleBob = AuthorGenerator::createUncleBob();
        $user = UserGenerator::createAdminUser();
        Passport::actingAs($user);

        $this->json(
            'DELETE',
            route('authors.destroy', [
                'author' => $uncleBob->id,
            ])
        )
            ->assertStatus(200);

        $this->assertDatabaseMissing('authors', [
            'id' => $uncleBob->id,
        ]);
    }
}
