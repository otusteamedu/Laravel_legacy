<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Requests\Companies\StoreCompany;
use App\Http\Requests\Companies\UpdateCompany;
use App\Services\Companies\CompanyService;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CompanyController extends Controller
{
    private $companyService;
    
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $companies = $this->companyService->paginateCompaniesWithTrashed();
        
        return view('admin.models.companies.index', compact('companies'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $addressFields = Company::addressFields();
        
        return view('admin.models.companies.create', compact('addressFields'));
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
        $this->companyService->createCompany($request->all());
        
        return redirect()->route('admin.companies.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company  $company
     *
     * @return Factory|View
     */
    public function edit(Company $company)
    {
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
        $this->companyService->restoreCompany($id);
        
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
        $this->companyService->forceDeleteCompany($id);
        
        return redirect()->route('admin.companies.index');
    }
}
