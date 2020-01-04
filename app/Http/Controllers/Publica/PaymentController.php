<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Models\User;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IPaymentService;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;

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

    }

    public function processPayment(Request $request)  {
        /** @var User $user */
        $user = $this->userService->currentUser();
        if(!$user)
            return redirect(route('public.order.auth'));

        $order_number =
        $payment_id =

        return view('public.order.payinput'//,
        //    compact('contactData', 'items', 'summary')
        );
    }
}
