<?php


namespace App\Services\Image\Handlers;


use App\Services\Image\Repositories\ImageRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class GetImageDetailedHandler
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
     * @param int $id
     * @return JsonResource
     */
    public function handle(int $id): JsonResource {
        return $this->repository->showForEdit($id);
    }
}
