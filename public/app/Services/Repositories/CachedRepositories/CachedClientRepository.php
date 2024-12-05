<?php

namespace App\Services\Repositories\CachedRepositories;


use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tags;
use App\Services\ClientsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CachedClientRepository
{
    const CACHE_TTL = 10;

    private $clientsService;
    private  $cacheKeyManager;

    public function __construct(ClientsService $clientsService, CacheKeyManager $cacheKeyManager)
    {
        $this->clientsService = $clientsService;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function clearClientsCache()
    {
        Cache::tags(Tags::CLIENTS_TAG)->flush();
    }

    public function searchClients(Request $request)
    {
        return Cache::tags(Tags::CLIENTS_TAG)->remember(
            $this->cacheKeyManager->getClientKey($request),
            self::CACHE_TTL,
            function () {
                return $this->clientsService->index();
        });
    }

    public function addCachePage($data, int $page, int $ttl)
    {
        $cacheKey = $this->cacheKeyManager->getClientKeyByPage($page);

        Cache::tags(Tags::CLIENTS_TAG)->add(
            $this->cacheKeyManager->getClientKeyByPage($page),
            $data,
            $ttl);

        return $cacheKey;
    }
}
