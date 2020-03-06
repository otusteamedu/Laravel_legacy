<?php

namespace App\Listeners\Cache;

use App\Events\Models\Model as ModelEvent;
use App\Services\Base\Resource\CmsBaseResourceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

abstract class ClearByTag
{
    private CmsBaseResourceService $service;

    /**
     * ClearCategoryCache constructor.
     * @param CmsBaseResourceService $service
     */
    public function __construct(CmsBaseResourceService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  ModelEvent $event
     * @return void
     */
    public function handle(ModelEvent $event)
    {
        $this->service->clearCacheByTag();
    }
}
