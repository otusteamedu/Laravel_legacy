<?php


namespace App\Services\Cache\Handler;


use App\Services\Adverts\AdvertsService;
use App\Services\Messages\MessagesService;

class CacheWarmingHandler
{

    const QTY_ON_PAGE = 8;

    protected $advertService;
    protected $messagesService;

    /**
     *
     * @param AdvertsService $advertService
     * @param MessagesService $messagesService
     */

    public function __construct(
        AdvertsService $advertService,
        MessagesService $messagesService)
    {
        $this->advertService = $advertService;
        $this->messagesService = $messagesService;
    }

    public function forgetCacheKeys(array $keys)
    {
        foreach ($keys as $key){
            \Cache::forget($key);
        }
    }

    public function warmCache()
    {
        $this->advertService->showAdvertList();
        $this->advertService->page(self::QTY_ON_PAGE);
        $this->messagesService->showMessageList();
    }
}
