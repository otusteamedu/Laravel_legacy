<?php

namespace App\Services\Reviews\Repositories;

use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReviewRepository {

    public function find(int $id) {
        return Review::query()->find($id);
    }

    public function search(): LengthAwarePaginator {
        return Review::query()->orderByDesc('created_at')->paginate();
    }

    public function destroy(array $ids) {
        return Review::destroy($ids);
    }

    public function createFromArray(array $data) {
        $review = new Review();
        $review->fill($data);
        $review->save();

        return $review;
    }

    public function updateFromArray(Review $review, array $data) {
        $review->update($data);
        return $review;
    }
}
