<?php


namespace App\Services\Cart;


use App\Services\Cart\Handlers\AddHandler;
use App\Services\Cart\Handlers\DeleteHandler;
use App\Services\Cart\Handlers\SyncHandler;
use App\Services\Cart\Repositories\ClientCartRepository;

class ClientCartService
{
    private ClientCartRepository $repository;
    private SyncHandler $syncHandler;
    private AddHandler $addHandler;
    private DeleteHandler $deleteHandler;

    /**
     * ClientCartService constructor.
     * @param ClientCartRepository $repository
     * @param SyncHandler $syncHandler
     * @param AddHandler $addHandler
     * @param DeleteHandler $deleteHandler
     */
    public function __construct(
        ClientCartRepository $repository,
        SyncHandler $syncHandler,
        AddHandler $addHandler,
        DeleteHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->syncHandler = $syncHandler;
        $this->addHandler = $addHandler;
        $this->deleteHandler = $deleteHandler;
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function sync(array $items)
    {
        return $this->syncHandler->handle($items);
    }

    /**
     * @param array $items
     * @return mixed
     */
    public function update(array $items)
    {
        return $this->repository->update(auth()->user(), $items);
    }

    /**
     * @param array $item
     * @return mixed
     */
    public function add(array $item)
    {
        return $this->addHandler->handle($item);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->deleteHandler->handle($id);
    }

    /**
     * @param array $requestData
     * @return mixed
     */
    public function setQty(array $requestData)
    {
        $user = auth()->user();
        $this->repository->setQty($user, $requestData['id'], $requestData['qty']);

        return json_decode($user->cart->items, true);
    }
}
