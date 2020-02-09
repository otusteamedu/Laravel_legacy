<?php

namespace App\Http\Controllers\Cms\Post\Rubric;

use App\Http\Controllers\Cms\Page\Requests\StoreRubricRequest;
use App\Http\Controllers\Cms\Page\Requests\UpdateRubricRequest;
use App\Models\Post\Rubric;
use App\Services\Cms\Post\RubricsService;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class RubricsController
 * @package App\Http\Controllers\Cms\Post\Rubric
 */
class RubricsController extends Controller
{
    /** @var RubricsService $rubricsService */
    protected $rubricsService;

    /**
     * RubricsController constructor.
     * @param RubricsService $rubricsService
     */
    public function __construct(RubricsService $rubricsService)
    {
        $this->rubricsService = $rubricsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('cms.rubric.index', [
            'rubrics' => $this->rubricsService->paginationList(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('cms.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRubricRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreRubricRequest $request)
    {
        $data = $request->getFormData();

        $url = $this->rubricsService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  Rubric  $rubric
     * @return Factory|View
     */
    public function show(Rubric $rubric)
    {
        return view('cms.rubric.show', ['rubric' => $rubric]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Rubric  $rubric
     * @return Factory|View
     */
    public function edit(Rubric $rubric)
    {
        return view('cms.rubric.edit', ['rubric' => $rubric]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRubricRequest  $request
     * @param  Rubric  $rubric
     * @return RedirectResponse|Redirector
     */
    public function update(UpdateRubricRequest $request, Rubric $rubric)
    {
        $data = $request->getFormData();

        $url = $this->rubricsService->update($rubric, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rubric  $rubric
     * @return RedirectResponse|Redirector
     */
    public function destroy(Rubric $rubric)
    {
        $url = $this->rubricsService->destroy($rubric);

        return redirect($url);
    }
}
