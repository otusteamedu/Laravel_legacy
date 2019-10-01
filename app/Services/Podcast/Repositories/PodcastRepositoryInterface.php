<?php


namespace App\Services\Podcast\Repositories;


use App\Models\Podcast;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PodcastRepositoryInterface
{
    public function find(int $id): ?Podcast;

    public function search(array $filters = [], User $user = null): LengthAwarePaginator;

    public function createFromArray(array $data): Podcast;

    public function updateFromArray(Podcast $podcast, array $data): Podcast;

    public function delete(Podcast $podcast): void;

    /**
     * Возвращает массив подкастов в формате id => name
     * @param User $user
     * @return array
     */
    public function getPodcastsOptions(User $user): array;
}
