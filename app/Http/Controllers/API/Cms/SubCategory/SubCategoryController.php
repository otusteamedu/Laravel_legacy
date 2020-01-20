<?php

namespace App\Http\Controllers\API\Cms\SubCategory;

use App\Http\Controllers\API\Cms\Base\BaseCategoryController;
use App\Services\SubCategory\SubCategoryService;

abstract class SubCategoryController extends BaseCategoryController
{
    /**
     * SubCategoryController constructor.
     * @param SubCategoryService $service
     */
    public function __construct(SubCategoryService $service)
    {
        parent::__construct($service);
    }
}
