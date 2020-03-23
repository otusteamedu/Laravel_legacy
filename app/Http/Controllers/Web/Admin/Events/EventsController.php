<?php

namespace App\Http\Controllers\Web\Admin\Events;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Events\Requests\StoreEventRequest;
use App\Http\Controllers\Web\Admin\Events\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Policies\Abilities;
use App\Services\Events\EventsService;
use Illuminate\Http\Request;

/**
 * Class EventsController
 * @package App\Http\Controllers\Web\Admin\Events
 */
class EventsController extends Controller
{
    protected $eventsService;

    /**
     * EventsController constructor.
     * @param EventsService $eventsService
     */
    public function __construct(EventsService $eventsService)
    {
        $this->eventsService = $eventsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Abilities::VIEW_ANY, Event::class);

        $eventList = $this->eventsService->searchEvents($request->all());
        \View::share([
            'eventList' => $eventList
        ]);

        return view('admin.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Event::class);

        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreEventRequest $request)
    {
        $this->authorize(Abilities::CREATE, Event::class);
        $event = $this->eventsService->storeEvent($request->getFormData());

        return redirect(route('admin.events.show', $event));
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
        $this->authorize(Abilities::VIEW, Event::class);

        return view('admin.events.show', [
            'event' => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Event $event)
    {
        $this->authorize(Abilities::UPDATE, Event::class);

        return view('admin.events.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize(Abilities::UPDATE, Event::class);
        $this->eventsService->updateEvent($event, $request->getFormData());

        return redirect(route('admin.events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Event $event)
    {
        $this->authorize(Abilities::DELETE, Event::class);
        $this->eventsService->deleteEvent($event);

        return view(
            'admin.events.destroy',
            [
                'event' => $event
            ]
        );
    }
}
