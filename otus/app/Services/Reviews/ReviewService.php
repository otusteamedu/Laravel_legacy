<?php

namespace App\Services\Reviews;

use App\Models\Review;
use App\Services\Reviews\Repositories\CachedReviewRepositoryInterface;
use App\Services\Reviews\Repositories\ReviewsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewService {

    private $reviewsRepository;
    private $cachedReviewRepository;

    public function __construct(ReviewsRepositoryInterface $reviewsRepository, CachedReviewRepositoryInterface $cachedReviewRepository) {
        $this->reviewsRepository = $reviewsRepository;
        $this->cachedReviewRepository = $cachedReviewRepository;
    }

    public function findReview(int $id): Review {
        return $this->reviewsRepository->find($id);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchReviews(array $filters = [], array $with = []): LengthAwarePaginator {
        return $this->cachedReviewRepository->search($filters, $with);
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
