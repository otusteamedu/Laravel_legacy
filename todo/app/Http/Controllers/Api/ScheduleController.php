<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Services\Schedules\ScheduleService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\BaseAdminController;


class ScheduleController extends BaseAdminController
{

    private $scheduleService;

    public function __construct(

        ScheduleService $scheduleService

    )
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $schedules = $this->scheduleService->searchSchedules();
        return response()->json(ScheduleResource::collection($schedules));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'days' => 'required|min:3|max:50',
            'time' => 'required|max:20'
        ]);
        $data = $request->except(['api_token']);
        $schedule = $this->scheduleService->storeSchedule($data);

        return response()->json($schedule);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'days' => 'required|min:3|max:50',
            'time' => 'required|max:20'
        ]);

        $schedule = $this->scheduleService->findSchedule($id);
        $data = $request->except(['api_token']);
        $schedule = $this->scheduleService->updateSchedule($schedule, $data);

        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->scheduleService->deleteSchedule($id);
        return response()->json(['deleted' => 'true']);
    }
}
