<?php

namespace App\Services\Pictures;

use App\Models\Picture;
use App\Services\Pictures\Handlers\CreatePictureHandler;
use App\Services\Pictures\Handlers\UpdatePictureHandler;
use App\Services\Pictures\Handlers\DeletePictureHandler;
use App\Services\Pictures\Repositories\PictureRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PicturesService
 * @package App\Services\Pictures
 */
class PicturesService
{
    private $createPictureHandler;
    private $updatePictureHandler;
    private $deletePictureHandler;
    private $pictureRepository;

    /**
     * PicturesService constructor.
     * @param CreatePictureHandler $createPictureHandler
     * @param UpdatePictureHandler $updatePictureHandler
     * @param DeletePictureHandler $deletePictureHandler
     * @param PictureRepositoryInterface $pictureRepository
     */
    public function __construct(
        CreatePictureHandler $createPictureHandler,
        UpdatePictureHandler $updatePictureHandler,
        DeletePictureHandler $deletePictureHandler,
        PictureRepositoryInterface $pictureRepository
    ) {
        $this->createPictureHandler = $createPictureHandler;
        $this->updatePictureHandler = $updatePictureHandler;
        $this->deletePictureHandler = $deletePictureHandler;
        $this->pictureRepository = $pictureRepository;
    }

    /**
     * @param int $id
     * @return Picture|null
     */
    public function findPicture(int $id)
    {
        return $this->pictureRepository->find($id);
    }

    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function searchPictures(array $filters): LengthAwarePaginator
    {
        return $this->pictureRepository->search($filters);
    }

    /**
     * @param array $data
     * @return Picture
     */
    public function storePicture(array $data): Picture
    {
        return $this->createPictureHandler->handle($data);
    }

    public function updateUser(Picture $picture, array $data): Picture
    {
        return $this->updatePictureHandler->handle($picture, $data);
    }

    /**
     * @param Picture $picture
     * @throws \Exception
     */
    public function deletePicture(Picture $picture) {
        return $this->deletePictureHandler->handle($picture);
    }
}
