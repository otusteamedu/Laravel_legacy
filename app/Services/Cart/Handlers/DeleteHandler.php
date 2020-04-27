<?php


namespace App\Services\Cart\Handlers;


use App\Services\Cart\Repositories\ClientCartRepository;

class DeleteHandler
{
    private ClientCartRepository $repository;

    /**
     * SyncHandler constructor.
     * @param ClientCartRepository $repository
     */
    public function __construct(ClientCartRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function handle(int $id)
    {
        $user = auth()->user();
        $cartItems = json_decode($user->cart->items, true);

        $items = array_filter($cartItems, function($item) use ($id) {
           return $item['id'] !== $id;
        });

        return $this->repository->update($user, array_values($items));
    }
}
