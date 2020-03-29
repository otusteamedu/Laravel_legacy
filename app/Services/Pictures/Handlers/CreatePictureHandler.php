<?php

namespace App\Services\Pictures\Handlers;

use App\Models\Picture;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;

/**
 * Class CreatePictureHandler
 * @package App\Services\Pictures\Handlers
 */
class CreatePictureHandler {
    private $pictureRepository;

    /**
     * CreatePictureHandler constructor.
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(
        PictureRepositoryInterface $pictureRepository
    )
    {
        $this->pictureRepository = $pictureRepository;
    }

    /**
     * @param array $data
     * @return Picture
     */
    public function handle(array $data): Picture
    {
        $data['path'] = trim($data['path']);

        return $this->pictureRepository->createFromArray($data);
    }
}
