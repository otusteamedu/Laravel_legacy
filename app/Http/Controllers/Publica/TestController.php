<?php


namespace App\Http\Controllers\Publica;


use App\Base\Service\ServiceException;
use App\Http\Controllers\Controller;
use App\Services\Exceptions\TicketException;
use Carbon\Carbon;

class TestController extends Controller {
    public function index(
        \App\Services\Interfaces\ITicketService $ticketService,
        \App\Services\Interfaces\IPlaceService $placeService,
        \App\Services\Interfaces\IMovieShowingService $movieShowingService,
        \App\Services\Interfaces\IOrderService $orderService
    ) {
        $order = $orderService->getOrderSession();
        dd($order);
        $product = \App\Repositories\Adapters\TicketProduct::getById(3);
        dd([
            $product->GetName(),
            $product->GetDescription(),
            $product->GetPrice(),
            $product->GetId(),
            $product->GetAvailable()
        ]);

        /** @var \App\Models\Place $place */
        $place = $placeService->findByID(635);
        /** @var \App\Models\MovieShowing $showing */
        $showing = $movieShowingService->findByID(7847);
        // 635 643
        try {
            $ticket = $ticketService->receiveTicket($showing, $place);
        }
        catch(TicketException $ex) {
            dd($ex->getMessages());
        }
        catch(ServiceException $ex) {
            dd($ex->getMessages());
        }
        catch(\Exception $ex) {
            dd($ex->getMessage());
        }

        dd($ticket);
    }
}
