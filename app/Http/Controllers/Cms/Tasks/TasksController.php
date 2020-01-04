<?php

namespace App\Http\Controllers\Cms\Tasks;

use App\Http\Controllers\Cms\Tasks\Requests\TaskStoreRequest;
use App\Http\Controllers\Cms\Tasks\Requests\TaskUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Policies\Abilities;
use App\Services\Tasks\TasksService;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    protected $taskService;
    protected $users;
    protected $projects;

    public function __construct(TasksService $service)
    {
        $this->taskService = $service;
        $this->users = $this->taskService->getFormUsers();
        $this->projects = $this->taskService->getFormProjects();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW, Task::class);

        $data = $this->taskService->getForm(config('pages.COUNT_TASKS_CMS'));
        return view('cms.Tasks.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Task::class);

        return view('cms.Tasks.add', ['projects' => $this->projects, 'users' => $this->users]);
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
        $result = $this->taskService->getFormCreate($data);

        if ($result) {
            return redirect()
                ->route('csm.tasks.index')
                ->with(['status' => 'Задача успешно добавлена']);
        }
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
        $this->authorize(Abilities::VIEW, Task::class);

        return view('cms.Tasks.edit', [
            'task' => $task,
            'users' => $this->users,
            'projects' => $this->projects
        ]);
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
        $result = $this->taskService->updateForm($task, $data);

        if ($result) {
            return redirect()
                ->route('csm.tasks.index')
                ->with(['status' => 'Задача успешно обновлена']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize(Abilities::DELETE,User::class, Task::class);

        $result = $this->taskService->deleteForm($id);

        if ($result) {
            return redirect()
                ->route('csm.tasks.index')
                ->with(['status' => 'Задача успешно удалена']);
        }

    }
}
