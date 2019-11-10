<?php

namespace Tests\Feature\Controllers;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Category;
use App\Models\Handbook;
use App\Models\Material;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class ReviewsControllerTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     * @group controllers
     */

    public function testCreateReviewIfInvalidUserIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.reviews.store'), [
                'material_id' => factory(Material::class)->create()->id,
                'review' => $this->faker->text(100)
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateReviewIfInvalidMaterialIdParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.reviews.store'), [
                'user_id' => factory(User::class)->create()->id,
                'review' => $this->faker->text(100)
            ])
            ->assertSessionHasErrors();
    }

    public function testCreateReviewIfInvalidReviewParam() {
        $user = UserGenerator::createEditorUser();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.reviews.store'), [
                'user_id' => factory(User::class)->create()->id,
                'material_id' => factory(Material::class)->create()->id,
            ])
            ->assertSessionHasErrors();
    }


    public function testFailDeleteReview() {
        $user = UserGenerator::createSimpleUser();
        /** @var Collection $collection */

        $collection = factory(\App\Models\Review::class, 1)->create();
        /** @var Review $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.reviews.destroy', ['review' => $item]))
            ->assertStatus(403);
    }

    public function testSuccessStoreReview() {
        $user = UserGenerator::createEditorUser();
        $review = $this->createReview();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.reviews.store'), $review)
            ->assertStatus(301);

        $this->assertDatabaseHas('reviews', [
            'review' => $review['review']
        ]);
    }

    public function testCreatedOnlyOneReview() {
        $user = UserGenerator::createEditorUser();
        $review = $this->createReview();

        $count = Review::all()->count();

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->post(route('admin.reviews.store'), $review)
            ->assertStatus(301);

        $this->assertEquals($count + 1, Review::all()->count());
    }

    public function testSuccessDeleteReview() {
        $user = UserGenerator::createEditorUser();
        /** @var Collection $collection */

        $count = Review::all()->count();

        $collection = factory(\App\Models\Review::class, 1)->create();
        /** @var Review $item */
        $item = $collection->get(0);

        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($user)
            ->delete(route('admin.reviews.destroy', ['review' => $item]))
            ->assertStatus(200);

        $this->assertEquals($count, Review::all()->count());
    }

    private function createReview() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'material_id' => factory(Material::class)->create()->id,
            'review' => $this->faker->text(100)
        ];
    }
}
