<?php


namespace App\Services\Episode\Repositories;


use App\Models\Episode;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EpisodeRepositoryInterface
{
    public function find(int $id): ?Episode;

    public function search(array $filters = []): LengthAwarePaginator;

    public function createFromArray(array $data): Episode;

    public function updateFromArray(Episode $podcast, array $data): Episode;

    public function delete(Episode $podcast): void;
}
