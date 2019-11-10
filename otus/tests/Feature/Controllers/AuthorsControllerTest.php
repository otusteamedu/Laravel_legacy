<?php

namespace Tests\Controllers\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AuthorsControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */


    public function testCreateAuthorIfInvalidNameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.authors.store'), [
                'surname' => $this->faker->lastName,
            ])
           ->assertSessionHasErrors();
    }

    public function testCreateAuthorIfInvalidSurnameParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.authors.store'), [
                'name' => $this->faker->name,
            ])
            ->assertSessionHasErrors();
    }


    public function testFailStoreAuthor() {
        $user = UserGenerator::createSimpleUser();
        $author = $this->createAuthor();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.authors.store'), $author)
            ->assertStatus(403);
    }

    public function testFailDeleteAuthor() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $authorsCollection */

        $collection = factory(\App\Models\Author::class, 1)->create();
        /** @var Author $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.authors.destroy', ['author' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreAuthor() {
        $user = UserGenerator::createEditorUser();
        $author = $this->createAuthor();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.authors.store'), $author)
            ->assertStatus(301);

        $this->assertDatabaseHas('authors', [
            'name' => $author['name']
        ]);
    }

    public function testCreatedOnlyOneAuthor() {
        $user = UserGenerator::createEditorUser();
        $author = $this->createAuthor();

        $count = Author::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.authors.store'), $author)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Author::all()->count());
    }

    public function testSuccessDeleteAuthor() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $authorsCollection */

        $count = Author::all()->count();

        $collection = factory(\App\Models\Author::class, 1)->create();
        /** @var Author $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.authors.destroy', ['author' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Author::all()->count());
    }

    private function createAuthor() {
        return [
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            '_token' => csrf_token()
        ];
    }
}
