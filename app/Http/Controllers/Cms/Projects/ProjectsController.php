<?php

namespace App\Http\Controllers\Cms\Projects;

use App\Http\Controllers\Cms\Projects\Requests\ProjectStoreRequest;
use App\Http\Controllers\Cms\Requests\ProjectUpdateRequest;
use App\Http\Controllers\Cms\Requests\TaskUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cms\Projects\Requests\TaskStoreRequest;
use App\Models\Project;
use App\Services\Projects\ProjectsService;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    protected $projectsService;

    public function __construct(ProjectsService $projectsService)
    {
        $this->projectsService = $projectsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->projectsService->getAll(config('pages.COUNT_PROJECTS_CMS'));
        return view('cms.projects.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.projects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $data = $request->getFormData();
        $result = $this->projectsService->saveForm($data);

        if ($result) {
            return redirect()
                ->route('csm.projects.index')
                ->with(['status' => 'Проект успешно добавлен']);
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
    public function edit(Project $project)
    {
        return view('cms.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $data = $request->getFormData();
        $result = $this->projectsService->updateForm($project, $data);
        if ($result) {
            return redirect()
                ->route('csm.projects.index')
                ->with(['status' => 'Проект успешно изменен']);
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
        $result = $this->projectsService->delForm($id);
        if ($result) {
            return redirect()
                ->route('csm.projects.index')
                ->with(['status' => 'Проект успешно удален']);
        }
    }
}
