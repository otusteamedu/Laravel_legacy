<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Requests\Companies\StoreCompany;
use App\Http\Requests\Companies\UpdateCompany;
use App\Policies\Abilities;
use App\Services\Companies\CompanyService;
use App\Traits\Auth\HasAuthorizationPolicy;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    use HasAuthorizationPolicy;
    
    protected $modelClass = Company::class;
    
    private $companyService;
    
    public function __construct(CompanyService $companyService)
    {
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
        
        $companies = $this->companyService->paginateCompaniesWithTrashed();
        
        return view('admin.models.companies.index', compact('companies'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function create()
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::CREATE);
        }
        
        $addressFields = Company::addressFields();
        $currentUser = $this->getCurrentUser();
        
        return view('admin.models.companies.create', compact('addressFields', 'currentUser'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompany  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCompany $request): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::CREATE);
        }
        
        $this->companyService->createCompany($request->all());
        
        return redirect()->route('admin.companies.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company  $company
     *
     * @return Factory|RedirectResponse|View
     */
    public function edit(Company $company)
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $company)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::UPDATE);
        }
        
        $addressFields = Company::addressFields();
        
        return view('admin.models.companies.edit', compact('company', 'addressFields'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCompany  $request
     * @param  Company  $company
     *
     * @return RedirectResponse
     */
    public function update(UpdateCompany $request, Company $company): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $company)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::UPDATE);
        }
        
        $this->companyService->updateCompany($company, $request->all());
        
        return redirect()->route('admin.companies.edit', compact('company'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Company  $company
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Company $company): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::DELETE, $company)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::DELETE);
        }
        
        $this->companyService->deleteCompany($company);
        
        return redirect()->route('admin.companies.index');
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
        $company = $this->companyService->findCompanyWithTrashed($id);
        
        if (!$company) {
            return redirect()->route('admin.companies.index')->with('errors', __('admin.companies.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::RESTORE, $company)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::RESTORE);
        }
        
        $this->companyService->restoreCompany($company);
        
        return redirect()->route('admin.companies.index');
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
        $company = $this->companyService->findCompanyWithTrashed($id);
        
        if (!$company) {
            return redirect()->route('admin.companies.index')->with('errors', __('admin.companies.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::FORCE_DELETE, $company)) {
            return $this->redirectIfNoPermission('admin.companies.index', Abilities::FORCE_DELETE);
        }
        
        $this->companyService->forceDeleteCompany($company);
        
        return redirect()->route('admin.companies.index');
    }
}
