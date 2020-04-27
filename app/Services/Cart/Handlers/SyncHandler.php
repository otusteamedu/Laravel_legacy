<?php


namespace App\Services\Cart\Handlers;


use App\Services\Cart\Repositories\ClientCartRepository;

class SyncHandler
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
     * @param array $items
     * @return mixed
     */
    public function handle(array $items)
    {
        $user = auth()->user();

        $storeData = $items;

        if ($user->cart) {
            $cart = $user->cart;
            $cartItems = json_decode($cart->items, true);
            $storeData = array_values(collect([...$items, ...$cartItems])
                ->unique('id')
                ->toArray());
        }

        return $this->repository->update($user, $storeData);
    }
}
