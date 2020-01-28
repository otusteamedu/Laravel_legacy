<?php

namespace App\Http\Controllers\Cms\Tasks;

use App\Http\Controllers\Cms\Tasks\Requests\TaskStoreRequest;
use App\Http\Controllers\Cms\Tasks\Requests\TaskUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Services\Projects\ProjectsService;
use App\Services\Tasks\TasksService;
use App\Services\Users\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TasksController extends Controller
{
    protected $taskService;
    protected $projectsService;
    protected $userService;

    public function __construct(
        TasksService $service,
        ProjectsService $projectsService,
        UsersService $userService
    ) {
        $this->taskService = $service;
        $this->projectsService = $projectsService;
        $this->userService = $userService;
    }

    public function shareUserAndProjects()
    {
        $users = $this->userService->getFormUsers();
        $projects = $this->projectsService->getFormProjects();
        View::share(['users' => $users, 'projects' => $projects,]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->taskService->getTask(config('pages.COUNT_TASKS_CMS'));
        return view('cms.tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->shareUserAndProjects();
        return view('cms.tasks.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->getFormData();
        $result = $this->taskService->createTask($data);

        return redirect()
            ->route('csm.tasks.index')
            ->with(['status' => 'Задача успешно добавлена']);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->shareUserAndProjects();
        return view('cms.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $data = $request->getFormData();
        $result = $this->taskService->updateTask($task, $data);

        return redirect()
            ->route('cms.tasks.index')
            ->with(['status' => 'Задача успешно обновлена']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $result = $this->taskService->deleteTask($task);

        return redirect()
            ->route('csm.tasks.index')
            ->with(['status' => 'Задача успешно удалена']);
    }
}
