<?php


namespace App\Services\Order;


use App\Mail\OrderInProcess;
use App\Services\Order\Handlers\CreateOrderHandler;
use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\Key;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Order\Repositories\ClientOrderRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ClientOrderService extends ClientBaseResourceService
{
    private CreateOrderHandler $createOrderHandler;

    /**
     * ClientOrderService constructor.
     * @param ClientOrderRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     * @param CreateOrderHandler $createOrderHandler
     */
    public function __construct(
        ClientOrderRepository $repository,
        CacheKeyManager $cacheKeyManager,
        CreateOrderHandler $createOrderHandler
    )
    {
        parent::__construct($repository, $cacheKeyManager);
        $this->createOrderHandler = $createOrderHandler;
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function store(array $requestData)
    {
        $order = $this->createOrderHandler->handle($requestData);

//        $customerEmail = json_decode($requestData['customer'])->email;
        $customerEmail = json_decode($order->customer)->email;

//        $this->getMailFormatOrderHandler->handle($order);

        return $order->number;
    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Collection|mixed
//     */
//    public function index()
//    {
//        $key = $this->cacheKeyManager->getResourceKey(Key::DELIVERY_PREFIX, ['published']);
//
//        return Cache::tags(Tag::DELIVERY_TAG)->remember($key, TTL::DELIVERY_TTL, function () {
//            return $this->repository->index();
//        });
//    }
}
