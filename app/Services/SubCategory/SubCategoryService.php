<?php


namespace App\Services\SubCategory;


use App\Services\Base\Category\CmsBaseCategoryService;
use App\Services\Base\Category\Handlers\GetExcludedImagesHandler;
use App\Services\Base\Category\Handlers\GetImagesHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\SubCategory\Repositories\SubCategoryRepository;

abstract class SubCategoryService extends CmsBaseCategoryService
{
    /**
     * SubCategoryService constructor.
     * @param SubCategoryRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param GetImagesHandler $showImagesHandler
     * @param GetExcludedImagesHandler $showExcludedImagesHandler
     */
    public function __construct(
        SubCategoryRepository $repository,
        ClearCacheByTagHandler $clearCacheByTagHandler,
        UploadHandler $uploadHandler,
        GetImagesHandler $showImagesHandler,
        GetExcludedImagesHandler $showExcludedImagesHandler
    )
    {
        parent::__construct(
            $repository,
            $clearCacheByTagHandler,
            $uploadHandler,
            $showImagesHandler,
            $showExcludedImagesHandler
        );
    }
}
