<?php

namespace App\Http\Controllers;

use App\Services\Projects\ProjectsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Overview extends Controller
{
    /**
     * @var ProjectsService
     */
    private $projectsService;

    public function __construct(ProjectsService $projectsService)
    {
        $this->projectsService = $projectsService;
    }

    public function index()
    {
        $projects = $this->projectsService->searchProjects(10);
        $projects->load('tasks');

        return view('overview.index')->with([
            'title'    => __('overview/general.title'),
            'balance'  => Auth::user()->balance,
            'projects' => $projects->items(),
            'tasks'    => [
                'today'    => 10,
                'tomorrow' => 17,
            ],
        ]);
    }

}
