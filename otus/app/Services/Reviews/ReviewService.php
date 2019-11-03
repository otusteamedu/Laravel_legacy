<?php

namespace App\Services\Reviews;

use App\Models\Review;
use App\Services\Reviews\Repositories\ReviewsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewService {

    private $reviewsRepository;

    public function __construct(ReviewsRepositoryInterface $reviewsRepository) {
        $this->reviewsRepository = $reviewsRepository;
    }

    public function findReview(int $id) {
        return $this->reviewsRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchReviews(): LengthAwarePaginator {
        return $this->reviewsRepository->search();
    }

    /**
     * @param array $data
     * @return Review
     */
    public function storeReview(array $data): Review {
        return $this->reviewsRepository->createFromArray($data);
    }

    /**
     * @param Review $review
     * @param array $data
     */
    public function updateReview(Review $review, array $data) {
        $this->reviewsRepository->updateFromArray($review, $data);
    }

    /**
     * @param array $ids
     */
    public function destroyReview(array $ids) {
        $this->reviewsRepository->destroy($ids);
    }
}
