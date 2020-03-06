<?php

namespace App\Listeners\Cache\Category;

use App\Listeners\Cache\ClearByTag;
use App\Services\Base\Category\CmsBaseCategoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CategoryClearByTag extends ClearByTag
{
    public function __construct(CmsBaseCategoryService $service)
    {
        parent::__construct($service);
    }
}
