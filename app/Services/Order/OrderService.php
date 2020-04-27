<?php


namespace App\Services\Order;


use App\Events\Models\Order\OrderSaved;
use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cart\ClientCartService;
use App\Services\Order\Handlers\StoreHandler;
use App\Services\Order\Repositories\ClientOrderRepository;

class OrderService extends ClientBaseResourceService
{
    private StoreHandler $storeHandler;
    private ClientCartService $cartService;

    /**
     * OrderService constructor.
     * @param ClientOrderRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     * @param StoreHandler $storeHandler
     * @param ClientCartService $cartService
     */
    public function __construct(
        ClientOrderRepository $repository,
        CacheKeyManager $cacheKeyManager,
        StoreHandler $storeHandler,
        ClientCartService $cartService
    )
    {
        parent::__construct($repository, $cacheKeyManager);
        $this->storeHandler = $storeHandler;
        $this->cartService = $cartService;
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function store(array $requestData)
    {
        $order = $this->storeHandler->handle($requestData);

        if (auth()->user()) {
            $this->cartService->update([]);
        }

        event(new OrderSaved($order));

        return $order->number;
    }
}
