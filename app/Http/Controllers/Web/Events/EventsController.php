<?php

namespace App\Http\Controllers\Web\Events;

use App\Models\Event;
use App\Policies\Abilities;
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

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Event $event)
    {
        return view('events.show', [
            'event' => $event
        ]);
    }
}
