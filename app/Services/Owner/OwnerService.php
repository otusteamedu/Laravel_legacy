<?php


namespace App\Services\Owner;


use App\Http\Requests\FormRequest;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Owner\Repositories\OwnerRepository;
use App\Services\SubCategory\SubCategoryService;

class OwnerService extends SubCategoryService
{
    /**
     * OwnerService constructor.
     * @param OwnerRepository $repository
     * @param UploadHandler $uploadHandler
     */
    public function __construct(
        OwnerRepository $repository,
        UploadHandler $uploadHandler
    )
    {
        parent::__construct($repository, $uploadHandler);
    }

    /**
     * @param array $images
     * @param int $id
     */
    public function associateWithImages(array $images, int $id)
    {
        array_map(function ($image) use ($images, $id) {
            $image->owner_id = $id;
            $image->save();
        }, $images);
    }

    /**
     * @param FormRequest $request
     * @param int $id
     */
    public function addImages(FormRequest $request, int $id)
    {
        $images = $request->toArray();
        $this->repository->addImages($id, $images);
    }
}
