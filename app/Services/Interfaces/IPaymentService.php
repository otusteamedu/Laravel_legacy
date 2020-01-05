<?php


namespace App\Services\Interfaces;

use App\Base\Service\IBaseService;
use App\Models\Order;
use App\Models\Payment;

/**
 * Interface IPaymentService
 *
 * 1. Для заказа можно инициировать неограниченное количество попыток оплаты, в случае если заказ является неоплаченным.
 * 2. Модель попытки оплаты - Payment
 * 3. Если у заказа существует попытка оплаты со стадией выполнено (stage=done, is_error=false),
 *      заказ считается оплаченным. Создание новых попыток оплаты при этом запрещено.
 * 4. В один момент времени может существовать только одна активная попытка оплаты. Активной попыткой оплаты считается
 *      та, у которой стадия не равна "выполнено" и попытка не завершилась ошибкой (stage != done, is_error=false)
 * 5. У каждой попытки оплаты существует время жизни - payment_ttl сек. с момента последнего обновления
 *      попытки оплаты, по истечению которых поптыка считается ошибочной is_error -> true
 * 6. Оплата проходит следующие стадии stage.
 * - new - только что создана, ожидаем ввода данных карты
 * - input - завершена попытка отправки данных во внешний сервис по адресу payment_gateway
 * - code - завершена попытка ввода проверочного кода
 * - done - оплата принята
 * 7. Оплачивать возможно только свой заказ. Считаем, что все $order уже проверены заранее в контроллерах,
 * Но оплаты проверяем дополнительно
 *
 * @package App\Services\Interfaces
 */
interface IPaymentService extends IBaseService
{
    // получить/создать текущую актуальную оплату по заказу
    public function receiveOrderPayment(Order $order): Payment;
    // получить платеж по ИД
    public function getPayment(string $payment_id): ?Payment;
    // получить платеж по ИД и проверить
    public function getValidPayment(string $payment_id): Payment;
    // получить удачную оплату
    public function getDonePayment(Order $order): ?Payment;
    // хватает ли прав на оплату заказа
    public function authOrder(Order $order): bool;
    // не прошло ли время, отведенное на оплату
    public function checkTTL(Payment $payment): bool;

    public function inputCardData(Payment $payment, array $data): Payment;
    public function sendCardData(Payment $payment): bool;
    public function inputCheckData(Payment $payment, string $check_code): Payment;
    public function sendCheckData(Payment $payment): bool;

    public function finalizePayment(Payment $payment): void;
}

