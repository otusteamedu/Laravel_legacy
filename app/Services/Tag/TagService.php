<?php


namespace App\Services\Tag;


use App\Services\Base\Category\Handlers\GetExcludedImagesHandler;
use App\Services\Base\Category\Handlers\GetImagesHandler;
use App\Services\Base\Category\Handlers\UploadHandler;
use App\Services\Base\Resource\Handlers\ClearCacheByTagHandler;
use App\Services\SubCategory\SubCategoryService;
use App\Services\Tag\Repositories\TagRepository;

class TagService extends SubCategoryService
{
    /**
     * TagService constructor.
     * @param TagRepository $repository
     * @param ClearCacheByTagHandler $clearCacheByTagHandler
     * @param UploadHandler $uploadHandler
     * @param GetImagesHandler $showImagesHandler
     * @param GetExcludedImagesHandler $showExcludedImagesHandler
     */
    public function __construct(
        TagRepository $repository,
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
