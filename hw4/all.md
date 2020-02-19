# Большой и жирный

### толстый контроллер

Данный контролер обрабатывает запросы связанные с работой заказа.
Он немного разжирел и если в данный момент проводит его рефакторинг, то можно было бы применить паттерн 
"Шаблонный метод", т.к. все операции повторяются.

Также у нас в методе есть такие зависимости как:

```php
...
        BookingService $bookingService,
        NetPrice $netPrice,
        BookingCurrencyService $bookingCurrencyService,
...
```

Их можно было бы объденить в "Цепочка обязанностей", что то вроде middleware

```php
class ApiOperation
{
    protected $factory;

    public function __construct(DriverFactory $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke(
        Request $request,
        Response $response,
        OrderLoadValidator $validator,
        OrderRepository $orderRepository,
        BookingService $bookingService,
        NetPrice $netPrice,
        BookingCurrencyService $bookingCurrencyService,
        $operationName
    ) {
        if (!$validator->validate($request)) {
            return $response->withJson($validator->getError(), 500);
        }

        $orderRequest = OrderRequest::mapper($validator->get());

        //$db->getConnection()->beginTransaction();

        try {
            $order = $orderRepository->findById($orderRequest->getOrderId());
        } catch (ModelNotFoundException $e) {
            throw new OrderException("Заказ №{$orderRequest->getOrderId()} не найден или создан под другим аккаунтом");
        }

        if($order->isFreeLock() === 0) {
            throw new OrderException("Заказ №{$order->id} находится в процессе выполнения другого запроса");
        }

        if($order->getLock() === 0) {
            throw new OrderException("Заказ №{$order->id} не удалось получить блокировку");
        }

        $driverClass = $this->factory->getClassById($order->provider_id);

        $orderResponse = new OrderResponse();
        $method = Str::upper($operationName);

        if($method !== OperationMethod::LOAD_STATUS) {
            /** @var OrderHistory $lastHistory */
            $lastHistory = $order->history()->create([
                'method' => $method,
                'status' => OperationStatus::UNKNOWN,
            ]);
        }

        try {
            $orderRequest->setProviderOrderId($order->provider_order_id);
            $orderRequest->setPartnerOrderId($order->partner_order_id);

            switch ($method) {
                case OperationMethod::LOAD_BOOKING:
                    $orderResponse = $driverClass->loadBooking($orderRequest);
                    if($orderResponse->getBookingFile()->getStatus() === OrderStatus::CANCELLED) {
                        if($order->isRefund() === false){
                            $order->refund_date = new \DateTimeImmutable();
                        }
                    }
                    break;
                case OperationMethod::ISSUE_BOOKING:
                    $orderResponse = $driverClass->loadBooking($orderRequest);
                    if($order->isIssue() === false && $orderResponse->getBookingFile()->getStatus() === OrderStatus::NEW) {
                        $order->issue_date = new \DateTimeImmutable();
                        $orderResponse->addInfoMessage('Бронирование отмечено, как оплаченное');
                    }
                    break;
                case OperationMethod::CANCEL_BOOKING:
                case OperationMethod::VOID_BOOKING:

                    if($method === OperationMethod::VOID_BOOKING){
                        if($order->isIssue()) {
                            throw new OrderException('Заказ не может быть аннулирован, т.к. он выписан, возможен только возврат');
                        }
                    }

                    $orderCancelInfo = $driverClass->cancelBooking($orderRequest);
                    if($order->isRefund() === false){
                        $order->refund_date = new \DateTimeImmutable();
                    }
                    $order->penalty_amount = $orderCancelInfo->getPenalty();
                    $order->refund_amount = $orderCancelInfo->getPrice();

                    $orderResponse = $driverClass->loadBooking($orderRequest);
                    break;
                case OperationMethod::LOAD_STATUS:
                    $orderResponse = $driverClass->loadBooking($orderRequest);

                    return $response->withJson([
                        'status' => $orderResponse->getBookingFile()->getStatus()
                    ]);
                    break;
                default:
                    throw new OrderException('Неизвестная операция');
            }

            //обновляем инфомацию о продуктах в базе данных
            //нужно для сохранения всех статусов продукта
            $bookingService->updateInvoices($order, $orderResponse->getBookingFile());
            //$bookingFile = $bookingService->loadInvoices($order)
            $bookingFile = $bookingService->updateBookingFile($order, $orderResponse->getBookingFile())
                ->setProvider($driverClass->getDriverName())
                ->setShortId($order->short_id)
                ->setPos($order->pos)
                ->setProviderOrderId($order->provider_order_id);

            $orderResponse->addInfoMessage('Информация о бронировании обновлена');
        } catch (DriverException $e) {
            $orderResponse->addErrorMessage($e->getMessage());
        }

        $isError = $orderResponse->getMessage(\App\Dictionary\Message::ERROR) !== null;

        if(isset($lastHistory)) {
            $lastHistory->update([
                'request' => $driverClass->getLastRequest(),
                'response' => $driverClass->getLastResponse(),
                'result_body' => isset($bookingFile) ? $bookingFile : null,
                'status' => $isError ? OperationStatus::ERROR : OperationStatus::OK,
                'booking_status' => $isError ? OperationStatus::UNKNOWN : $bookingFile->getStatus()
            ]);
        } else {
            /** @var OrderHistory $lastHistory */
            $lastHistory = $order->history()->create([
                'method' => $method,
                'request' => $driverClass->getLastRequest(),
                'response' => $driverClass->getLastResponse(),
                'result_body' => isset($bookingFile) ? $bookingFile : null,
                'status' => $isError ? OperationStatus::ERROR : OperationStatus::OK,
                'booking_status' => $isError ? OperationStatus::UNKNOWN : $bookingFile->getStatus()
            ]);
        }

        if (false === $isError) {
            $order->last_successful_request_id = $lastHistory->id;
            $order->status = isset($bookingFile) ? $bookingFile->getStatus() : OperationStatus::ERROR;
            $order->last_load_date = new \DateTimeImmutable();
        }

        $order->save();

        //$db->getConnection()->commit();

        if(isset($bookingFile)){
            if($order->account->net_price) {
                $netPrice->bookingFile($bookingFile, $order->account);
            }
            $bookingFile = $bookingCurrencyService->convert($bookingFile, $orderRequest->getCurrency());
            $orderResponse
                ->setBookingFile($bookingFile);
        }

        $orderResponse
            ->setOrderId($order->id)
            ->setAccountName($order->account->title);


        return $response->withJson($orderResponse);
    }
}
```