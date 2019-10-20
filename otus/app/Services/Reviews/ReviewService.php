<?php

namespace App\Services\Reviews;

use App\Models\Category;

use App\Models\Review;
use App\Services\Reviews\Repositories\ReviewRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewService {

    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository) {
        $this->reviewRepository = $reviewRepository;
    }

    public function findReview(int $id) {
        return $this->reviewRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchReviews(): LengthAwarePaginator {
        return $this->reviewRepository->search();
    }

    /**
     * @param array $data
     * @return Review
     */
    public function storeReview(array $data): Review {
        return $this->reviewRepository->createFromArray($data);
    }

    /**
     * @param Category $review
     * @param array $data
     */
    public function updateReview(Review $category, array $data) {
        $this->reviewRepository->updateFromArray($category, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyReview(array $ids) {
        $this->reviewRepository->destroy($ids);
    }
}
