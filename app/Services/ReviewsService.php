<?php


namespace App\Services;

use App\Repositories\ReviewsRepository;

class ReviewsService
{
    protected $reviewsRepository;

    public function __construct(
        ReviewsRepository $reviewsRepository
    )
    {
        $this->reviewsRepository = $reviewsRepository;
    }

    public function gelAllReviews(){
        return  $this->reviewsRepository->gelAllReviews();
    }

    public function storeReview($data){
        return  $this->reviewsRepository->storeReview($data);
    }

    public function updateReview($data, $review){
        return  $this->reviewsRepository->updateReview($data, $review);
    }

    public function destroyReview($id){
        $this->reviewsRepository->destroyReview($id);
    }

    /**
     * @param $userId
     * @return bool
     */
    public function hasReview($userId){
          $review = $this->reviewsRepository->hasReview($userId);
          if(count($review)>0){
              return true;
          } else {
              return false;
          }
    }
}