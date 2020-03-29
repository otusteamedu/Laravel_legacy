<?php

namespace App\Services\Pictures\Handlers;

use App\Models\Picture;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;

/**
 * Class UpdatePictureHandler
 * @package App\Services\Pictures\Handlers
 */
class UpdatePictureHandler
{
    private $pictureRepository;

    /**
     * UpdatePictureHandler constructor.
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
     * @param array $data
     * @return Picture
     */
    public function handle(Picture $picture, array $data): Picture
    {
        if (isset($data['path'])) {
            $data['path'] = trim($data['path']);
        }

        return $this->pictureRepository->updateFromArray($picture, $data);
    }
}
