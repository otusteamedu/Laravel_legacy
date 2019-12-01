<?php

namespace Tests\Unit;

use App\Models\Material;
use App\Models\Review;
use App\Models\User;
use App\Services\Reviews\ReviewService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewServiceTest extends TestCase {

    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     * @group services
     */

    public function testFindItemById() {
        $service = app()->make(ReviewService::class);

        $collection = factory(\App\Models\Review::class, 1)->create();
        /** @var Review $item */
        $item = $collection->get(0);

        $result = $service->findReview($item->id);
        $this->assertNotNull($result);
    }

    public function testFindItems() {

        $service = app()->make(ReviewService::class);

        $count = Review::all()->count();

        factory(\App\Models\Review::class, 3)->create();

        /** @var Collection $collection */

        $collection = $service->searchReviews();

        $this->assertEquals($count + 3, $collection->count());
    }

    public function testStoreReviewTableHasName() {

        $service = app()->make(ReviewService::class);

        factory(Review::class, 3)->create();

        $review = $this->createReview();

        $service->storeReview($review);

        $this->assertDatabaseHas('reviews', [
            'user_id' => $review['user_id']
        ]);
    }

    public function testStoreReviewCountIncrement() {
        $service = app()->make(ReviewService::class);
        $count = Review::all()->count();

        $review = $this->createReview();
        $service->storeReview($review);

        $this->assertEquals($count + 1, Review::all()->count());
    }

    public function testUpdateReview() {
        $service = app()->make(ReviewService::class);

        $collection = factory(\App\Models\Review::class, 3)->create();
        /** @var Review $item */
        $item = $collection->get(0);

        $service->updateReview($item, [
            'user_id' => $item->user_id,
        ]);

        $this->assertDatabaseHas('reviews', [
            'user_id' => $item->user_id
        ]);
    }

    public function testDeleteReview() {
        $service = app()->make(ReviewService::class);

        $collection = factory(\App\Models\Review::class, 3)->create();
        $count = Review::all()->count();

        $item = $collection->get(0);

        $service->destroyReview([$item->id]);

        $this->assertEquals($count - 1, Review::all()->count());
        $this->assertDatabaseMissing('reviews', [
            'id' => $item->id
        ]);
    }

    private function createReview() {
        return [
            'user_id' => factory(User::class)->create()->id,
            'material_id' => factory(Material::class)->create()->id,
            'review' => $this->faker->text(100)
        ];
    }
}
