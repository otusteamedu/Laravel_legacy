<?php


namespace App\Repositories;
use App\Models\Review;

class ReviewsRepository
{
    public function gelAllReviews()
    {
        return Review::with('user')->paginate();
    }

    public function storeReview($data){
        Review::create($data);
    }

    public function updateReview($data, $review){
        $review->update([
            'text' => $data['text']
        ]);
    }

    public function destroyReview($id){
        Review::destroy($id);
}

    public function hasReview($userId){
        return Review::where('user_id', $userId)->get();
    }
}