<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Widgets\StoreWidget;
use App\Http\Requests\Widgets\UpdateWidget;
use App\Models\Widget;
use App\Policies\Abilities;
use App\Services\Companies\CompanyService;
use App\Services\Widgets\WidgetService;
use App\Traits\Auth\HasAuthorizationPolicy;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WidgetController extends Controller
{
    use HasAuthorizationPolicy;
    
    protected $modelClass = Widget::class;
    
    private $widgetService;
    private $companyService;
    
    public function __construct(
        WidgetService $widgetService,
        CompanyService $companyService
    ) {
        $this->widgetService = $widgetService;
        $this->companyService = $companyService;
    
        $this->viewShareData();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function index()
    {
        if (!$this->authorizeUserAbility(Abilities::VIEW_ANY)) {
            return $this->redirectIfNoPermission('admin.dashboard', Abilities::VIEW_ANY);
        }
        
        $widgets = $this->widgetService->paginateWidgetsWithTrashed();
        
        return view('admin.models.widgets.index', compact('widgets'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::CREATE);
        }
        
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        $currentUser = $this->getCurrentUser();
        
        return view('admin.models.widgets.create', compact('companiesSelectList', 'currentUser'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreWidget  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreWidget $request): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::CREATE);
        }
        
        $this->widgetService->createWidget($request->all());
        
        return redirect()->route('admin.widgets.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Widget  $widget
     *
     * @return Factory|RedirectResponse|View
     */
    public function edit(Widget $widget)
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $widget)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::UPDATE);
        }
        
        return view('admin.models.widgets.edit', compact('widget'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateWidget  $request
     * @param  Widget  $widget
     *
     * @return RedirectResponse
     */
    public function update(UpdateWidget $request, Widget $widget): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $widget)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::UPDATE);
        }
        
        $this->widgetService->updateWidget($widget, $request->all());
        
        return redirect()->route('admin.widgets.edit', compact('widget'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Widget  $widget
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Widget $widget): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::DELETE, $widget)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::DELETE);
        }
        
        $this->widgetService->deleteWidget($widget);
        
        return redirect()->route('admin.widgets.index');
    }
    
    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $widget = $this->widgetService->findWidgetWithTrashed($id);
    
        if (!$widget) {
            return redirect()->route('admin.widgets.index')->with('errors', __('admin.widgets.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::RESTORE, $widget)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::RESTORE);
        }
        
        $this->widgetService->restoreWidget($widget);
        
        return redirect()->route('admin.widgets.index');
    }
    
    /**
     * Permanently delete the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $widget = $this->widgetService->findWidgetWithTrashed($id);
    
        if (!$widget) {
            return redirect()->route('admin.widgets.index')->with('errors', __('admin.widgets.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::FORCE_DELETE, $widget)) {
            return $this->redirectIfNoPermission('admin.widgets.index', Abilities::FORCE_DELETE);
        }
        
        $this->widgetService->forceDeleteWidget($widget);
        
        return redirect()->route('admin.widgets.index');
    }
}
