<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Base\Service\ServiceException;
use App\Models\Payment;
use App\Models\User;
use App\Services\Exceptions\OrderException;
use App\Services\Exceptions\PaymentException;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IPaymentService;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class PaymentController
 *
 * Общие ошибки (проверки до каких-либо операций)
 *
 * 1. Оплата/заказ по указанным идентификатороам не найден - 404
 * 2. Заказ не принадлежит текущему пользователю - 403 - доступ запрещен
 * 3. Заказ не находится в статусе confirmed "подтвержден"
 *
 * Оплата проходит по шагам (stage)
 * 1. Пользователь пересылается на оплату из заказа в createPayment.
 *      Создается объект оплаты со stage==created или используется текущий активный is_error==false, stage==<any>
 * 2. В случае, если произошла любая ошибка в процессе оплаты is_error==true, пересылаем клиента в paymentStatus.
 *      Причины установки is_error -> true
 *      2.1. Истекло TTL
 *      2.2. Сервис оплаты выдал ошибку при проверке данных клиента. Проблемы с соединением тут не учитываются
 * 3. Шаги:
 *      created - объект создан ожидаем ввод данных карты
 *          Если установлена is_error (может быть только из-за TTL) пересылаем в paymentStatus.
 *          Обнаружится данный статус может при обновлении страницы.
 *
 *      card_input - данные карты успешно введены, ожидается отправка данных в сервис оплаты.
 *          Если введены невалидные с точки зрения локального валидатора ValidationError данные осталяем в форме ввода.
 *          Если установлена is_error (может быть только из-за TTL) пересылаем в paymentStatus
 *      card_checked - данные карты проверены внешним сервисом.
 *          Если ошибка (TTL или ответ с ошибкой проверки от сервиса оплаты), пересылаем в paymentStatus
 *          Если успех обновляем страницу ввода данных
 *      code_input - аналогично card_input
 *      code_checked - аналогично card_checked
 *      после успешного code_checked мы устанавливаем заказ оплаченным, а оплату в статус done
 *
 * @package App\Http\Controllers\Publica
 */
class PaymentController extends AbstractController
{
    /**
     * @var IOrderService
     */
    private $orderService;
    /**
     * @var IPaymentService
     */
    private $paymentService;
    /**
     * @var IUserService
     */
    private $userService;
    /**
     * PaymentController constructor.
     * @param IOrderService $orderService
     * @param IPaymentService $paymentService
     * @param IUserService $userService
     */
    public function __construct(
        IOrderService $orderService,
        IPaymentService $paymentService,
        IUserService $userService
    ) {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->userService = $userService;
    }

    public function createPayment(Request $request)  {
        /** @var User $user */
        $user = $this->userService->currentUser();

        $order_number = (string) $request->get('order_number');
        $order = $this->orderService->getUserOrder($user, $order_number);
        if(!$order)
            abort(403);

        $backUrl = route('public.order.confirmed', ['order_number' => $order->number]);
        try {
            $payment = $this->paymentService->receiveOrderPayment($order);
        }
        catch (PaymentException $exception) {
            return redirect($backUrl)->withErrors($exception->getMessages(), 'messages');
        }
        catch (OrderException $exception) {
            return redirect($backUrl)->withErrors($exception->getMessages(), 'messages');
        }

        return redirect(route('public.payment.input',
            ['payment_id' => $payment->payment_id]));
    }
    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function inputFormPayment(Request $request)  {
        // Проверяем - можем ли мы осуществлять ввод данных по оплате?
        $payment_id = (string) $request->get('payment_id');
        if(!$payment = $this->paymentService->getPayment($payment_id))
            abort(404);
        if(!$this->paymentService->authOrder($payment->order))
            abort(403);
        if($payment->is_error || !$this->paymentService->checkTTL($payment))
            return redirect(route('public.payment.status', ['payment_id' => $payment->payment_id]));

        // Проверяем - нужно ли осуществлять ввод данных по оплате?
        if($payment->stage == Payment::STAGE_DONE)
            return redirect(route('public.payment.status', ['payment_id' => $payment->payment_id]));

        // получаем данные из формы и объеденяем их с ранее введенными данными
        $inputData = $request->input('input', []);
        if(!is_array($inputData)) $inputData = [];

        $inputData = array_merge(
            [
                'card_number' => '',
                'card_person' => '',
                'card_term' => '',
                'card_csv' => '',
                'check_code' => ''
            ],
            $payment->payment_data,
            $inputData
        );

        return view('public.order.payinput',
            [
                'payment' => $payment->toArray(),
                'order' => $payment->order->toArray(),
                'inputData' => $inputData
            ]
        );
    }

    public function inputSavePayment(Request $request)  {
        $payment_id = (string) $request->get('payment_id');
        $redirectTo = redirect(route('public.payment.input', ['payment_id' => $payment_id]));

        try {
            $payment = $this->paymentService->getValidPayment($payment_id);

            if($payment->stage == Payment::STAGE_CREATED) {
                $inputData = $request->input('input', []);
                if(!is_array($inputData)) $inputData = [];

                $this->paymentService->inputCardData($payment, $inputData);
            }
            elseif ($payment->stage == Payment::STAGE_CARD_CHECKED) {
                $checkCode = (string) $request->input('check_code', '');
                $this->paymentService->inputCheckData($payment , $checkCode);
            }
        }
        catch (ServiceException $exception) {
            return $redirectTo
                ->withErrors($exception->getMessages(), 'messages')
                ->withInput();
        }
        catch (ValidationException $exception) {
            return $redirectTo
                ->withErrors($exception->errors())
                ->withInput();
        }

        return $redirectTo;
    }

    public function processPayment(Request $request)  {
        $payment_id = (string) $request->get('payment_id');
        $result = [
            'is_blocked' => false,
            'is_error' => false,
            'message' => '',
            'stage' => '',
            'redirectTo' => route('public.payment.input', ['payment_id' => $payment_id])
        ];
        try {
            $payment = $this->paymentService->getValidPayment($payment_id);
            if($payment->stage == Payment::STAGE_CARD_INPUT)
                $this->paymentService->sendCardData($payment);
            elseif($payment->stage == Payment::STAGE_CODE_INPUT) {
                $bResult = $this->paymentService->sendCheckData($payment);
                if($bResult)
                    $this->paymentService->finalizePayment($payment);
            }

            $payment = $this->paymentService->getPayment($payment_id);
            $result['is_blocked'] =  $payment->is_blocked;
            $result['is_error'] = $payment->is_error;
            $result['message'] = $payment->message;
            $result['stage'] = $payment->stage;
        }
        catch (PaymentException $ex) {
            $payment = $this->paymentService->getPayment($payment_id);
            if($payment) {
                $result['is_blocked'] =  $payment->is_blocked;
                $result['is_error'] = $payment->is_error;
                $result['message'] = $payment->message;
                $result['stage'] = $payment->stage;
            }
            else {
                $result['is_error'] = true;
                $result['message'] = $ex->getMessages();
            }
        }
        catch (OrderException $ex) {
            $result['is_error'] = true;
            $result['message'] = __('errors.payment.session');
        }

        return response()->json($result);
    }

    public function paymentStatus(Request $request)  {
        $payment_id = (string) $request->get('payment_id');
        if(!$payment = $this->paymentService->getPayment($payment_id))
            abort(404);
        if(!$this->paymentService->authOrder($payment->order))
            abort(403);

        if(($payment->stage != Payment::STAGE_DONE) && !$payment->is_error)
            return redirect(route('public.payment.input', ['payment_id' => $payment_id]));

        return view('public.order.paystatus',
            [
                'payment' => $payment->toArray(),
                'order' => $payment->order->toArray()
            ]
        );
    }
}
