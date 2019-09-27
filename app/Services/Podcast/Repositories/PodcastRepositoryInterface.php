<?php


namespace App\Services\Podcast\Repositories;


use App\Models\Podcast;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PodcastRepositoryInterface
{
    public function find(int $id): ?Podcast;

    public function search(array $filters = []): LengthAwarePaginator;

    public function createFromArray(array $data): Podcast;

    public function updateFromArray(Podcast $podcast, array $data): Podcast;

    public function delete(Podcast $podcast): void;
}
