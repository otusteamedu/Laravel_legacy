<?php

namespace App\Http\Controllers\Cms\Post\Rubric;

use App\Http\Controllers\Cms\CurrentUser;
use App\Http\Controllers\Cms\Page\Requests\StoreRubricRequest;
use App\Http\Controllers\Cms\Page\Requests\UpdateRubricRequest;
use App\Models\Post\Rubric;
use App\Policies\Abilities;
use App\Services\Cms\Post\RubricsService;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class RubricsController
 * @package App\Http\Controllers\Cms\Post\Rubric
 */
class RubricsController extends Controller
{
    use CurrentUser;

    /** @var RubricsService $rubricsService */
    protected $rubricsService;

    /** @var string */
    protected $locale;

    /**
     * RubricsController constructor.
     * @param RubricsService $rubricsService
     */
    public function __construct(RubricsService $rubricsService)
    {
        $this->rubricsService = $rubricsService;
        $this->locale = \App::getLocale();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $this->checkAbility($request, Abilities::VIEW_ANY, Rubric::class);

        return view('cms.rubric.index', [
            'rubrics' => $this->rubricsService->paginationList(),
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Rubric::class);

        return view('cms.rubric.create', [
            'locale' => $this->locale,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRubricRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreRubricRequest $request)
    {
        $this->checkAbility($request, Abilities::CREATE, Rubric::class);

        $data = $request->getFormData();

        $url = $this->rubricsService->store($data);

        return redirect($url);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Rubric $rubric
     * @return Factory|View
     */
    public function show(Request $request, Rubric $rubric)
    {
        $this->checkAbility($request, Abilities::VIEW, $rubric);

        return view('cms.rubric.show', [
            'rubric' => $rubric,
            'locale' => $this->locale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Rubric $rubric
     * @return Factory|View
     */
    public function edit(Request $request, Rubric $rubric)
    {
        $this->checkAbility($request, Abilities::UPDATE, $rubric);

        return view('cms.rubric.edit', [
            'rubric' => $rubric,
            'locale' => $this->locale,
        ]);
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
        $this->checkAbility($request, Abilities::UPDATE, $rubric);

        $data = $request->getFormData();

        $url = $this->rubricsService->update($rubric, $data);

        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Rubric $rubric
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, Rubric $rubric)
    {
        $this->checkAbility($request, Abilities::DELETE, $rubric);

        $url = $this->rubricsService->destroy($rubric);

        return redirect($url);
    }
}
