<?php


namespace App\Services\Cart\Handlers;


use App\Services\Cart\Repositories\ClientCartRepository;
use Illuminate\Support\Arr;

class AddHandler
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
     * @param array $item
     * @return mixed
     */
    public function handle(array $item)
    {
        $user = auth()->user();
        $cartItems = $user->cart ? json_decode($user->cart->items, true) : [];
        $items = Arr::collapse([$cartItems, $item]);

        return $this->repository->update($user, array_values($items));
    }
}
