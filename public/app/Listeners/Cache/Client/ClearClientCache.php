<?php


namespace App\Listeners\Cache\Client;


use App\Services\Repositories\CachedRepositories\CachedClientRepository;

class ClearClientCache
{
    private $cachedClientRepository;

    public function __construct(CachedClientRepository $cachedClientRepository)
    {
        $this->cachedClientRepository = $cachedClientRepository;
    }

    public function handle()
    {
        $this->cachedClientRepository->clearClientsCache();
    }
}
