<?php


namespace App\Repositories\Interfaces\Adapters;

use App\Models\User;

/**
 * Interface IProduct
 *
 * Адаптер между объектом, который можно купить и позицией заказа
 *
 * @package App\Repositories\Interfaces\Adapters
 */
interface IProduct
{
    /**
     * Идентификатор, по которому будем искать исходных объект со стороны корзины
     * @return int
     */
    public function GetId(): int;

    /**
     * Найти себя по индентификатору, сохраненному в корзине/заказе
     * @param int $id
     * @return IProduct
     */
    public static function getById(int $id): IProduct;
    /**
     * Узнать стоимость. В общем случае может быть завязана на систему скидок и прочее
     * @return float
     */
    public function GetPrice(): float;
    /**
     * Проверить доступность для покупки
     * @return bool
     */
    public function GetAvailable(): bool;
    /**
     * Имя, под которым объект будет храниться в корзине/заказе
     * @return string
     */
    public function GetName(): string;
    /**
     * Покупаемый объект должен быть реализован. В терминах корзины - значит продан.
     * В понятии покупаемого объекта - значит заблокирован
     *
     * @param User $user
     */
    public function Release(User $user): void;
    /**
     * Реализован ли объект?
     * @return bool
     */
    public function IsReleased(): bool;
}
