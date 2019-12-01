<?php

namespace App\Services\Reviews\Repositories;

use App\Models\Review;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReviewsRepositoryInterface {

    public function find(int $id);

    public function search(array $filters = [], array $with = []): LengthAwarePaginator;

    public function destroy(array $ids);

    public function createFromArray(array $data): Review;

    public function updateFromArray(Review $review, array $data): Review;
}
