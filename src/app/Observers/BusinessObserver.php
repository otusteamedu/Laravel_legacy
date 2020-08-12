<?php

namespace App\Observers;

use App\Models\Business;
use App\Services\Businesses\BusinessService;
use App\Services\CacheKeyGeneration;
use Illuminate\Support\Facades\Cache;

class BusinessObserver
{
    /**
     * @var BusinessService
     */
    private $service;

    public function __construct(
        BusinessService $service
    )
    {
        $this->service = $service;
    }

    /**
     * Handle the business "updated" event.
     *
     * @param Business $business
     * @return void
     */
    public function updated(Business $business)
    {
        $id = $business->getOriginal("id");
        $key = CacheKeyGeneration::getKey(Business::CACHE_PREFIX, $id);

        Cache::forget($key);
        $this->service->get($id);
    }

    /**
     * Handle the business "deleted" event.
     *
     * @param Business $business
     * @return void
     */
    public function deleted(Business $business)
    {
        $key = CacheKeyGeneration::getKey(Business::CACHE_PREFIX, $business->id);
        Cache::forget($key);
    }
}
