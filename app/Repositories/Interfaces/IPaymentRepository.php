<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\Order;
use App\Models\Payment;

interface IPaymentRepository extends IBaseRepository
{
    public function getPaymentByUuid(string $payment_id): ?Payment;
    public function getActiveOrderPayment(Order $order, string $stage = null): ?Payment;
}
