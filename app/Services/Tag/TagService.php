<?php


namespace App\Services\Tag;


use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\SubCategory\SubCategoryService;
use App\Services\Tag\Repositories\TagRepository;

class TagService extends SubCategoryService
{
    /**
     * TagService constructor.
     * @param TagRepository $repository
     * @param UploadHandler $uploadHandler
     */
    public function __construct(
        TagRepository $repository,
        UploadHandler $uploadHandler
    )
    {
        parent::__construct($repository, $uploadHandler);
    }
}
