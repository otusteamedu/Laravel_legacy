<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Leads\StoreLead;
use App\Http\Requests\Leads\UpdateLead;
use App\Models\Lead;
use App\Policies\Abilities;
use App\Services\Companies\CompanyService;
use App\Services\Leads\LeadService;
use App\Http\Controllers\Controller;
use App\Traits\Auth\HasAuthorizationPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LeadController extends Controller
{
    use HasAuthorizationPolicy;
    
    protected $modelClass = Lead::class;
    
    private $leadService;
    private $companyService;
    
    public function __construct(
        LeadService $leadService,
        CompanyService $companyService
    ) {
        $this->leadService = $leadService;
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
        
        $leads = $this->leadService->paginateLeadsWithTrashed();
        
        return view('admin.models.leads.index', compact('leads'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::CREATE);
        }
        
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        $currentUser = $this->getCurrentUser();
        
        return view('admin.models.leads.create', compact('companiesSelectList', 'currentUser'));
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
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::CREATE);
        }
        
        $this->leadService->createLead($request->all());
        
        return redirect()->route('admin.leads.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lead  $lead
     *
     * @return Factory|RedirectResponse|View
     */
    public function edit(Lead $lead)
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $lead)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::UPDATE);
        }
        
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
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $lead)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::UPDATE);
        }
        
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
        if (!$this->authorizeUserAbility(Abilities::DELETE, $lead)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::DELETE);
        }
        
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
        $lead = $this->leadService->findLeadWithTrashed($id);
        
        if (!$lead) {
            return redirect()->route('admin.leads.index')->with('errors', __('admin.leads.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::RESTORE, $lead)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::RESTORE);
        }
        
        $this->leadService->restoreLead($lead);
        
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
        $lead = $this->leadService->findLeadWithTrashed($id);
        
        if (!$lead) {
            return redirect()->route('admin.leads.index')->with('errors', __('admin.leads.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::FORCE_DELETE, $lead)) {
            return $this->redirectIfNoPermission('admin.leads.index', Abilities::FORCE_DELETE);
        }
        
        $this->leadService->forceDeleteLead($lead);
        
        return redirect()->route('admin.leads.index');
    }
}
