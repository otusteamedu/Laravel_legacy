<?php

namespace App\Services\Events\Models\Review;

use App\Models\Review;

class ReviewEvent {
    /** @var Review */
    private $review;

    public function __construct(Review $review) {
        $this->review = $review;
    }

    /**
     * @return Review
     */
    public function getReview(): Review {
        return $this->review;
    }
}
