<?php

namespace App\Http\Controllers\Web\Admin\Events;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Events\Requests\StoreEventRequest;
use App\Http\Controllers\Web\Admin\Events\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\Events\EventsService;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    protected $eventsService;

    public function __construct(EventsService $eventsService)
    {
        $this->eventsService = $eventsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventList = $this->eventsService->searchEvents($request->all());
        \View::share([
            'eventList' => $eventList
        ]);

        return view('admin.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->eventsService->storeEvent($request->getFormData());

        return redirect(route('admin.events.show', $event));
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event)
    {
        return view('admin.events.show', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->eventsService->updateEvent($event, $request->getFormData());

        return redirect(route('admin.events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->eventsService->deleteEvent($event);

        return view(
            'admin.events.destroy',
            [
                'event' => $event
            ]
        );
    }
}
