<?php

namespace App\Listeners\Cache\Category;

use App\Events\Models\Category\Category;
use App\Services\Category\CmsCategoryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearCategoryCache
{
    private CmsCategoryService $service;

    /**
     * ClearCategoryCache constructor.
     * @param CmsCategoryService $service
     */
    public function __construct(CmsCategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  Category $event
     * @return void
     */
    public function handle(Category $event)
    {
        $this->service->clearCacheByTag();
    }
}
