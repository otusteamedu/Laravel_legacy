<?php


namespace App\Services;

use App\Base\Service\BaseService;
use App\Models\Order;
use App\Models\Payment;
use App\Repositories\Interfaces\IPaymentRepository;
use App\Services\Exceptions\OrderException;
use App\Services\Exceptions\PaymentException;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IPaymentService;
use App\Services\Interfaces\IUserService;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

class PaymentService extends BaseService implements IPaymentService
{
    const CMD_INPUT = 'input';
    const CMD_CHECK = 'check';

    const RES_SUCCESS = 'success';
    const RES_ERROR = 'error';

    /**
     * @var IOrderService
     */
    private $orderService;
    /**
     * @var IUserService
     */
    private $userService;
    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $config;

    public function __construct(
        IOrderService $orderService,
        IUserService $userService)
    {
        parent::__construct();
        $this->orderService = $orderService;
        $this->userService = $userService;

        $this->config = config('order');
    }
    public function receiveOrderPayment(Order $order): Payment {
        $this->validateOrder($order);

        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        $payment = $repository->getActiveOrderPayment($order);
        if($payment) {
            $this->validatePayment($payment);
            return $payment;
        }

        return $this->createOrderPayment($order);
    }
    public function createOrderPayment(Order $order): Payment {
        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        /** @var Payment $payment */
        $payment = $repository->createFromArray([
            'stage' => Payment::STATUS_NEW,
            'payment_data' => [],
            'order_id' => $order->id,
            'is_error' => false,
            'message' => '',
            'total' => $order->total,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return $payment;
    }

    public function getValidPayment(string $payment_id): Payment {
        $payment = $this->getPayment($payment_id);
        $this->validatePayment($payment);

        return $payment;
    }
    public function getPayment(string $payment_id): Payment {
        $payment = $this->findByUuid($payment_id);
        if(!$payment)
            throw new PaymentException(__('errors.payment.not_exists', ['payment_id' => $payment_id]));

        return $payment;
    }
    /**
     * Оплатить можно только свой заказ в статусе подтвержден
     * @param Order $order
     */
    private function validateOrder(Order $order) {
        $user = $this->userService->currentUser();

        if( !$user ||
            ($user->id != $order->buyer_id) ||
            $order->status != Order::STATUS_CONFIRMED)
            throw new OrderException(__('errors.payment.order_wrong'));
    }
    /**
     * Проверка на возможность провести операцию по оплате
     * @param Payment $payment
     */
    private function validatePayment(Payment $payment) {
        $this->validateOrder($payment->order);
        $this->checkTTL($payment);

        if($payment->is_error)
            throw new PaymentException(__('errors.payment.error', ['message' => $payment->message]));

        if($payment->total <= 0)
            throw new PaymentException(__('errors.payment.wrong_total'));
    }
    /**
     * @param Payment $payment
     */
    private function checkTTL(Payment $payment) {
        if($payment->is_error)
            return;

        $now = Carbon::now();
        $expired = $payment->updated_at->addSeconds((int) $this->config['payment_ttl']);
        if($now->gt($expired)) {
            $this->setError($payment, __('errors.payment.expired'));
        }
    }
    private function setStageStatus(Payment $payment, string $stage, string $message): Payment {
        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        /** @var Payment $payment */
        $payment = $repository->updateFromArray($payment, [
            'stage' => $stage,
            'message' => $message
        ]);

        return $payment;
    }
    private function setError(Payment $payment, string $message, string $stage = null): Payment {
        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        $data = [
            'is_error' => true,
            'message' => $message
        ];
        if($stage)
            $data['stage'] = $stage;

        /** @var Payment $payment */
        $payment = $repository->updateFromArray($payment, $data);

        return $payment;
    }
    /**
     * @param array $cardData
     */

    private function validateCardData(array $cardData) {
        \Illuminate\Support\Facades\Validator::make($cardData, [
            'card_number' => ['required', 'digits:16'],
            'card_person' => ['required'],
            'card_term' => ['required', 'regex:/^[0-9]{2}\/[0-9]{2}$/i'],
            'card_csv' => ['required', 'digits:3'],
        ], [
            'card_number.required' => __('errors.required', ['field' => __('public.payment.card_number')]),
            'card_number.digits' => __('errors.digits', ['field' => __('public.payment.card_number'), 'value' => 16]),
            'card_person.required' => __('errors.required', ['field' => __('public.payment.card_person')]),
            'card_term.required' => __('errors.required', ['field' => __('public.payment.card_term')]),
            'card_term.regex' => __('errors.wrong', ['field' => __('public.payment.card_term')]),
            'card_csv.required' => __('errors.required', ['field' => __('public.payment.card_csv')]),
            'card_csv.digits' => __('errors.digits', ['field' => __('public.payment.card_csv'), 'value' => 3])
        ])->validate();
    }
    /**
     * Вводить данные для валидной оплаты можно при верно введенным данным карты и если они еще не вводились
     *
     * @param Payment $payment
     * @param array $data
     */
    private function validateInput(Payment $payment, array $data) {
        $this->validatePayment($payment);

        if($payment->stage != Payment::STATUS_NEW)
            throw new PaymentException(__('errors.payment.wrong_stage_input'));

        $this->validateCardData($data);
    }
    public function inputCardData(Payment $payment, array $data): Payment {
        $this->validateInput($payment, array $data);

        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        /** @var Payment $payment */
        $payment = $repository->updateFromArray($payment, [
            'stage' => Payment::STATUS_INPUT,
            'payment_data' => $data,
            'updated_at' => Carbon::now()
        ]);

        return $payment;
    }
    public function sendCardData(Payment $payment): bool {
        $result = $this->sendQuery(
            $payment,
            array_merge(
                [
                    'request_id' => $payment->payment_id,
                    'cmd' => self::CMD_INPUT,
                    'total' => $payment->total
                ],
                $payment->payment_data
            ),
            'check'
        );
        if(!$result)
            return false;

        return true;
    }
    private function validateCheckData(string $check_code) {
        \Illuminate\Support\Facades\Validator::make(['check_code' => $check_code], [
            'check_code' => ['required', 'digits:6']
        ], [
            'check_code.required' => __('errors.required', ['field' => __('public.payment.check_code')]),
            'check_code.digits' => __('errors.digits', ['field' => __('public.payment.check_code'), 'value' => 6])
        ])->validate();
    }
    private function validateCheck(Payment $payment, string $check_code) {
        $this->validatePayment($payment);

        if($payment->stage != Payment::STATUS_INPUT)
            throw new PaymentException(__('errors.payment.wrong_stage_check'));

        $this->validateCheckData($check_code);
    }
    public function inputCheckData(Payment $payment, string $check_code): Payment {
        $this->validateCheck($payment, $check_code);
        $payment_data = $payment->payment_data;

        /** @var IPaymentRepository $repository */
        $repository = $this->getRepository();

        /** @var Payment $payment */
        $payment_data['check_code'] = $check_code;
        $payment = $repository->updateFromArray($payment, [
            'stage' => Payment::STATUS_CHECK,
            'payment_data' => $payment_data,
            'updated_at' => Carbon::now()
        ]);

        return $payment;
    }
    public function sendCheckData(Payment $payment): bool {
        return $this->sendQuery(
            $payment,
            array_merge(
                [
                    'request_id' => $payment->payment_id,
                    'cmd' => self::CMD_CHECK,
                    'total' => $payment->total
                ],
                $payment->payment_data
            ),
            Payment::STATUS_DONE
        );
    }

    private function sendQuery(Payment $payment, array $form_params, string $newStage): bool {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST' , $this->config['payment_gateway'] , [
                'form_params' => $form_params
            ]);

            if($response->getStatusCode() != 200) {
                $this->setError($payment , __('errors.payment.http' , [
                    'message' => '['.$response->getStatusCode().']'.$response->getReasonPhrase()
                ]));

                return false;
            }

            $result = json_decode($response->getBody());
            if($result['status'] != self::RES_SUCCESS) {
                $this->setError($payment , __('errors.payment.common' , [
                    'message' => $result['message']
                ]));
                return false;
            }
        }
        catch (GuzzleException $ex) {
            $this->setError($payment, __('errors.payment.http', ['message' => $ex->getMessage()]));
            return false;
        }

        $this->setStageStatus($payment, $newStage, $result['message']);
        return true;
    }
}
