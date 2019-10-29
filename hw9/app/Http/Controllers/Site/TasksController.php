<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Statuses\StatusesService;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\Tasks\TasksService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Cache;

class TasksController extends Controller
{

    protected $tasksService;
    protected $statusesService;
    protected $breadcrumbs;

    public function __construct(
        TasksService $tasksService
        //StatusesService $statusService
    )
    {
        $this->tasksService = $tasksService;
        //  $this->statusesService = $statusService;
        // $this->breadcrumbs = $this->getAdminBreadcrumbs();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        //$this->checkCurrentUserRouteAccess($user, $request->route()->getName());
        // $tasks = $this->tasksService->searchTasks(['user_id' => $user->id]);

        $tasks = $this->tasksService->searchCachedTasks();
        $data = [
            'tasks' => $tasks,
            'title' => 'TikTak - оптимальный сервис для управления своими задачами',
            'description' => ' Вот что мы знаем о нем',

        ];
        return view('tasks.index', $data);


    }

}
