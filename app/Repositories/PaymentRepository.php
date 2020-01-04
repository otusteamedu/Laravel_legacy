<?php


namespace App\Repositories;


use App\Base\Repository\BaseRepository;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Interfaces\IPaymentRepository;

class PaymentRepository extends BaseRepository implements IPaymentRepository
{

    public function getPaymentByUuid(string $payment_id): ?Payment
    {
        return $this->getModel()->newQuery()
            ->where('payment_id', $payment_id)
            ->get()->first();
    }

    public function getActiveOrderPayment(Order $order): ?Payment
    {
        return $this->getModel()->newQuery()
            ->where('order_id', $order->id)
            ->where('is_error', '<', 1)
            ->get()->first();
    }
}
