<?php


namespace App\Services\Cart\Repositories;


use App\Models\Cart;
use App\Services\Base\Resource\Repositories\ClientBaseResourceRepository;

class ClientCartRepository extends ClientBaseResourceRepository
{
    /**
     * ClientCartRepository constructor.
     * @param Cart $model
     */
    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    /**
     * @param $user
     * @param array $items
     * @return mixed
     */
    public function update($user, array $items)
    {
        $cart = $user->cart()->updateOrCreate(
            ['user_id' => $user->id],
            ['items' => json_encode($items, true)]
        );

        return json_decode($cart->items, true);
    }

    /**
     * @param $user
     * @param int $id
     * @param int $qty
     * @return mixed
     */
    public function setQty($user, int $id, int $qty)
    {
        $items = array_map(function($item) use ($id, $qty){
            if ($item['id'] === $id) {
                $item['qty'] = $qty;
            }
            return $item;
        }, json_decode($user->cart->items, true));

        return $user->cart()->update([
            'items' => json_encode($items, true)
            ]);
    }
}
