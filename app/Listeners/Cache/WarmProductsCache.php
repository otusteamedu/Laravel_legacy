<?php

namespace App\Listeners\Cache;

use App\Services\Products\Repositories\CachedProductsRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WarmProductsCache
{
    protected $cachedProductsRepository;

    /**
     * Create the event listener.
     *
     * @param  CachedProductsRepositoryInterface  $cachedProductsRepository
     */
    public function __construct(CachedProductsRepositoryInterface $cachedProductsRepository)
    {
        $this->cachedProductsRepository = $cachedProductsRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     *
     * @return void
     */
    public function handle($event)
    {
        $this->cachedProductsRepository->warmProduct($event);
    }
}
