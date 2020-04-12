<?php

namespace App\Http\Controllers\Web\Events;

use App\Services\Events\EventsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    protected $eventsService;

    public function __construct(EventsService $eventsService)
    {
        $this->eventsService = $eventsService;
    }

    public function index(Request $request)
    {
        $eventList = $this->eventsService->searchEvents($request->all());

        \View::share([
            'eventList' => $eventList
        ]);

        return view('events.index');
    }

}
