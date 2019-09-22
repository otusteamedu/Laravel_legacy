<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Widgets\StoreWidget;
use App\Http\Requests\Widgets\UpdateWidget;
use App\Models\Widget;
use App\Services\Companies\CompanyService;
use App\Services\Widgets\WidgetService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class WidgetController extends Controller
{
    private $widgetService;
    private $companyService;
    
    public function __construct(
        WidgetService $widgetService,
        CompanyService $companyService
    ) {
        $this->widgetService = $widgetService;
        $this->companyService = $companyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $widgets = $this->widgetService->paginateWidgetsWithTrashed();
        
        return view('admin.models.widgets.index', compact('widgets'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        
        return view('admin.models.widgets.create', compact('companiesSelectList'));
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
        $this->widgetService->createWidget($request->all());
        
        return redirect()->route('admin.widgets.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Widget  $widget
     *
     * @return Factory|View
     */
    public function edit(Widget $widget)
    {
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
        $this->widgetService->restoreWidget($id);
        
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
        $this->widgetService->forceDeleteWidget($id);
        
        return redirect()->route('admin.widgets.index');
    }
}
