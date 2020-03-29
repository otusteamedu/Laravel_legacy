<?php

namespace App\Services\Pictures\Handlers;

use App\Models\Picture;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;

/**
 * Class DeletePictureHandler
 * @package App\Services\Pictures\Handlers
 */
class DeletePictureHandler {
    private $pictureRepository;

    /**
     * DeletePictureHandler constructor.
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(
        PictureRepositoryInterface $pictureRepository
    )
    {
        $this->pictureRepository = $pictureRepository;
    }

    /**
     * @param Picture $picture
     * @throws \Exception
     */
    public function handle(Picture $picture): void
    {
        $picture->delete();
    }
}
