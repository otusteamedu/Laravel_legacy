<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Leads\StoreLead;
use App\Http\Requests\Leads\UpdateLead;
use App\Models\Lead;
use App\Services\Companies\CompanyService;
use App\Services\Leads\LeadService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LeadController extends Controller
{
    private $leadService;
    private $companyService;
    
    public function __construct(
        LeadService $leadService,
        CompanyService $companyService
    ) {
        $this->leadService = $leadService;
        $this->companyService = $companyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $leads = $this->leadService->paginateLeadsWithTrashed();
        
        return view('admin.models.leads.index', compact('leads'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        
        return view('admin.models.leads.create', compact('companiesSelectList'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLead  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreLead $request): RedirectResponse
    {
        $this->leadService->createLead($request->all());
        
        return redirect()->route('admin.leads.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lead  $lead
     *
     * @return Factory|View
     */
    public function edit(Lead $lead)
    {
        return view('admin.models.leads.edit', compact('lead'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLead  $request
     * @param  Lead  $lead
     *
     * @return RedirectResponse
     */
    public function update(UpdateLead $request, Lead $lead): RedirectResponse
    {
        $this->leadService->updateLead($lead, $request->all());
        
        return redirect()->route('admin.leads.edit', compact('lead'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Lead  $lead
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Lead $lead): RedirectResponse
    {
        $this->leadService->deleteLead($lead);
        
        return redirect()->route('admin.leads.index');
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
        $this->leadService->restoreLead($id);
        
        return redirect()->route('admin.leads.index');
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
        $this->leadService->forceDeleteLead($id);
        
        return redirect()->route('admin.leads.index');
    }
}
