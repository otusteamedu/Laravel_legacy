<?php


namespace App\Services\Image\Handlers;

use App\Services\Image\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;

class GetAllImagesHandler
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * GetAllImagesHandler constructor.
     * @param ImageRepository $repository
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function handle(): Collection {
        return $this->repository->index();
    }
}
