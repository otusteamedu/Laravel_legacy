<?php

namespace App\Services\Podcast;

use App\Models\Podcast;
use App\Services\Podcast\Repositories\PodcastRepositoryInterface;
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
     * @return LengthAwarePaginator
     */
    public function searchPodcasts(array $filters = []): LengthAwarePaginator
    {
        return $this->podcastRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Podcast
     */
    public function storePodcast(array $data): Podcast
    {
        $podcast = $this->podcastRepository->createFromArray($data);

        if (!empty($data['cover'])) {
            $this->handleCoverUpload($podcast, $data['cover']);
        }

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
        $filepath = $file->store('public/podcasts');
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
