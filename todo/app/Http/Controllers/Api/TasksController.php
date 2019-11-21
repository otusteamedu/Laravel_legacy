<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\Tasks\TasksService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\BaseAdminController;

class TasksController extends BaseAdminController
{

    private $tasksService;

    public function __construct(
        TasksService $tasksService
    )
    {
        $this->tasksService = $tasksService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());
        $tasks = $this->tasksService->searchTasks();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());
        $this->validate($request, [
            'title' => 'required|max:256',
            'description' => 'required'
        ]);
        $data = $request->except(['api_token']);
        $data['user_id'] = \Auth::id();
        $task = $this->tasksService->storeTask($data);
        return response()->json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task, Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());
        return response()->json(new TaskResource($task));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());

        $this->validate($request, [
            'title' => 'required|max:256',
            'description' => 'required'
        ]);
        $data = $request->except(['api_token']);
        $task = $this->tasksService->updateTask($task, $data);
        return response()->json(new TaskResource($task));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task, Request $request)
    {
        $user = Auth::user();
        $this->checkCurrentUserRouteAccess($user, $request->route()->getName());

        $res = $this->tasksService->deleteTask($task->id);

        return response()->json($res);
    }
}
