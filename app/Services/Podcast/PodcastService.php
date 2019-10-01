<?php

namespace App\Services\Podcast;

use App\Models\Podcast;
use App\Services\Podcast\Repositories\PodcastRepositoryInterface;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

class PodcastService
{
    /** @var PodcastRepositoryInterface */
    private $podcastRepository;

    public function __construct(PodcastRepositoryInterface $podcastRepository)
    {
        $this->podcastRepository = $podcastRepository;
    }

    /**
     * @param int $id
     * @return Podcast|null
     */
    public function findPodcast(int $id): ?Podcast
    {
        return $this->podcastRepository->find($id);
    }

    /**
     * @param array $filters
     * @param User|null $user
     * @return LengthAwarePaginator
     */
    public function searchPodcasts(array $filters = [], User $user = null): LengthAwarePaginator
    {
        return $this->podcastRepository->search($filters, $user);
    }

    /**
     * @param array $data
     * @return Podcast
     */
    public function storePodcast(array $data, User $user): Podcast
    {
        $podcast = $this->podcastRepository->createFromArray($data);

        if (!empty($data['cover'])) {
            $this->handleCoverUpload($podcast, $data['cover']);
        }

        $podcast->users()->attach($user);

        return $podcast;
    }

    /**
     * @param Podcast $podcast
     * @param array $data
     * @return void
     */
    public function updatePodcast(Podcast $podcast, array $data): void
    {
        $this->podcastRepository->updateFromArray($podcast, $data);

        if (!empty($data['cover'])) {
            $this->handleCoverUpload($podcast, $data['cover']);
        }
    }

    public function deletePodcast(Podcast $podcast): void
    {
        $this->podcastRepository->delete($podcast);
    }

    /**
     * @param Podcast $podcast
     * @param UploadedFile $file
     * @return void
     */
    public function handleCoverUpload(Podcast $podcast, UploadedFile $file): void
    {
        $filepath = $file->store('public/' . config('podcast-publisher.podcasts_cover_public_dir'));
        $this->podcastRepository->updateFromArray($podcast, ['cover_file' => $filepath]);
    }

    /**
     * Возвращает массив подкастов в формате id => name
     * @return array
     */
    public function getPodcasts(): array
    {
        return $this->podcastRepository->getPodcastsOptions();
    }
}
