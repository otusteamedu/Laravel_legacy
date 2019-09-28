<?php

namespace App\Http\Controllers\Schedule;

use App\Models\Schedule\Schedule;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    private $scheduleService;

    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * @return Response
     * @throws \Throwable
     */
    public function index()
    {
        $items = $this->scheduleService->index();
        $view = view('schedule/index', ['items' => $items])->render();

        return (new Response($view));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return (new Response(view('schedule/create')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->scheduleService->store($request);

        return redirect('schedule');
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     */
    public function show($id)
    {
        $model = $this->scheduleService->show($id);
        $view = view('schedule/edit', ['model' => $model])->render();

        return (new Response($view));
    }

    /**
     * @param Schedule $schedule
     * @return Response
     * @throws \Throwable
     */
    public function edit(Schedule $schedule)
    {
        $view = view('schedule/edit', ['model' => $schedule])->render();

        return (new Response($view));
    }

    /**
     * @param Request $request
     * @param Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->scheduleService->update($request, $schedule);

        return redirect('/schedule');
    }

    /**
     * @param Schedule $schedule
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */

    public function destroy(Schedule $schedule)
    {
        $this->scheduleService->destroy($schedule);

        return redirect('/schedule');
    }
}
