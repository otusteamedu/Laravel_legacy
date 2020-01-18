<?php


namespace App\Services\SubCategory;


use App\Services\Base\Category\BaseCategoryService;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\SubCategory\Repositories\SubCategoryRepository;

abstract class SubCategoryService extends BaseCategoryService
{
    /**
     * SubCategoryService constructor.
     * @param SubCategoryRepository $repository
     * @param UploadHandler $uploadHandler
     */
    public function __construct(
        SubCategoryRepository $repository,
        UploadHandler $uploadHandler
    )
    {
        parent::__construct($repository, $uploadHandler);
    }
}
