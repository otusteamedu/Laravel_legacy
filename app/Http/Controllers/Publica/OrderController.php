<?php


namespace App\Http\Controllers\Publica;

use App\Base\Controller\AbstractController;
use App\Base\Service\ServiceException;
use App\Models\MovieShowing;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Place;
use App\Models\User;
use App\Repositories\Adapters\TicketProduct;
use App\Services\Interfaces\IMovieShowingService;
use App\Services\Interfaces\IOrderService;
use App\Services\Interfaces\IPlaceService;
use App\Services\Interfaces\ITicketService;
use App\Services\Interfaces\IUserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends AbstractController
{
    private $orderService;
    private $placeService;
    private $movieShowingService;
    private $ticketService;
    private $userService;

    /**
     * OrderController constructor.
     * @param IOrderService $orderService
     * @param IPlaceService $placeService
     * @param IMovieShowingService $movieShowingService
     * @param ITicketService $ticketService
     * @param IUserService $userService
     */
    public function __construct(
        IOrderService $orderService,
        IPlaceService $placeService,
        IMovieShowingService $movieShowingService,
        ITicketService $ticketService,
        IUserService $userService
    ) {
        $this->orderService = $orderService;
        $this->placeService = $placeService;
        $this->movieShowingService = $movieShowingService;
        $this->ticketService = $ticketService;
        $this->userService = $userService;
    }
    public function sessionData(Request $request) {
        $this->orderService->updateOrderSession();
        $order = $this->orderService->getOrderSession();

        $itemsList = [];
        $items = $this->orderService->getOrderItems($order);
        /** @var OrderItem $item */
        foreach ($items as $item) {
            $item['ticket'] = $this->ticketService->findModel($item['product_id']);
            $itemsList[] = $item;
        }

        return response()->json(array_merge($order->toArray(), ['items' => $itemsList]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addTicket(Request $request) {
        // $
        $showing_movie_id = (int) $request->get('showing_movie_id', 0);
        $place_id = (int) $request->get('place_id', 0);
        /** @var MovieShowing $showing */
        $showing = $this->movieShowingService->findModel($showing_movie_id);
        /** @var Place $place */
        $place = $this->placeService->findModel($place_id);

        $result = [];
        try {
            $ticket = $this->ticketService->receiveTicket($showing, $place);

            $product = TicketProduct::getById($ticket->id);
            $item = $this->orderService->addSessProduct($product);
            $result['status'] = 'success';
            $result['message'] = __('public.order.ticketSuccessAdd');
            $result['data'] = $item->toArray();
        }
        catch(ServiceException $ex) {
            $result['status'] = 'error';
            $result['message'] = $ex->getMessages();
        }

        return response()->json($result);
    }
    public function removeTicket(Request $request) {
        $showing_movie_id = (int) $request->get('showing_movie_id', 0);
        $place_id = (int) $request->get('place_id', 0);
        $ticket_id = (int) $request->get('ticket_id', 0);

        /** @var MovieShowing $showing */
        $showing = $this->movieShowingService->findModel($showing_movie_id);
        /** @var Place $place */
        $place = $this->placeService->findModel($place_id);

        $result = [];
        try {
            if($ticket_id > 0)
                $ticket = $this->ticketService->findModel($ticket_id);
            else
                $ticket = $this->ticketService->receiveTicket($showing, $place);

            $product = TicketProduct::getById($ticket->id);
            $this->orderService->removeSessProduct($product);

            $result['status'] = 'success';
            $result['message'] = __('public.order.ticketSuccessRemove');
        }
        catch(ServiceException $ex) {
            $result['status'] = 'error';
            $result['message'] = $ex->getMessages();
        }

        return response()->json($result);
    }

    public function removeItem(Request $request) {
        $order = $this->orderService->getOrderSession();
        $item_id = (int) $request->get('item_id', 0);

        /** @var OrderItem $item */
        $item = $this->orderService->getOrderItem($order, $item_id);
        if($item)
            $this->orderService->removeItem($order, $item);

        if($request->isXmlHttpRequest()) {
            return response()->json([
                'status' => 'success',
                'message' => __('public.order.ticketSuccessRemove')
            ]);
        }

        $this->status(__('public.order.ticketSuccessRemove'));
        return redirect(route('public.order.checkout'));
    }

    public function checkoutOrder(Request $request)  {
        /** @var User $user */
        $user = $this->userService->currentUser();
        if(!$user)
            return redirect(route('public.order.auth'));

        $this->orderService->updateOrderSession();
        $order = $this->orderService->getOrderSession();
        $items = $this->orderService->getOrderItems($order);
        $summary = $this->orderService->summaryOrderSession();

        $contactData = array_merge(
            [
                'name' => $user->fullName(),
                'phone' => $user->phone,
                'email' => $user->email
            ],
            $request->old('contact', [])
        );

        return view('public.order.checkout',
            compact('contactData', 'items', 'summary')
        );
    }

    public function confirmOrder(Request $request)  {
        /** @var User $user */
        $user = $this->userService->currentUser();
        if(!$user)
            return redirect(route('public.order.auth'));

        $contactData = $request->input('contact', []);
        if(!is_array($contactData)) $contactData = [];

        try {
            /** @var Order $order */
            $order = $this->orderService->confirmOrderSession($contactData);
            $this->status(__('public.order.confirmed'));
        }
        catch (ValidationException $exception) {
            return redirect(route('public.order.checkout'))
                ->withErrors($exception->errors())
                ->withInput();
        }
        catch (ServiceException $exception) {
            return redirect(route('public.order.checkout'))
                ->withErrors($exception->getMessages(), 'messages')
                ->withInput();
        }

        return redirect(route('public.order.confirmed', ['order_number' => $order->number]));
    }

    public function confirmedOrder(Request $request) {
        /** @var User $user */
        $user = $this->userService->currentUser();
        if(!$user)
            return redirect(route('login', ['routeTo' => $request->getUri()]));

        $order_number = (string) $request->get('order_number');
        $order = $this->orderService->getUserOrder($user, $order_number);
        if(!$order)
            abort(403);

        return view('public.order.confirmed', ['order' => $order->toArray()]);
    }

    public function payOrder(Request $request): View {
        //$

        return view('public.order.checkout'//,
        //compact('movie', 'places', 'hall', 'showing', 'prices')
        );
    }

    public function authOrder(Request $request) {

    }

    public function quickRegister(Request $request) {

    }
}
