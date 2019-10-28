<?php

namespace App\Services\Companies;

use App\Models\Company;
use App\Repositories\Companies\CompanyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    private $companyRepository;
    
    public function __construct(
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->companyRepository = $companyRepository;
    }
    
    /**
     * Get all companies
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allCompanies($columns = []): Collection
    {
        return $this->companyRepository->all($columns);
    }
    
    /**
     * Paginate companies
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateCompanies(int $perPage = 15): LengthAwarePaginator
    {
        return $this->companyRepository->paginate($perPage);
    }
    
    /**
     * Paginate companies incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateCompaniesWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->companyRepository->paginateWithTrashed($perPage);
    }
    
    /**
     * Create company
     *
     * @param  array  $data
     *
     * @return Company
     */
    public function createCompany(array $data): Company
    {
        return $this->companyRepository->create($data);
    }
    
    /**
     * Find company by id
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function findCompany(int $id): ?Company
    {
        return $this->companyRepository->find($id);
    }
    
    /**
     * Find company by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function findCompanyWithTrashed(int $id): ?Company
    {
        return $this->companyRepository->findWithTrashed($id);
    }
    
    /**
     * Update company
     *
     * @param  Company  $company
     * @param  array  $data
     *
     * @return Company
     */
    public function updateCompany(Company $company, array $data): Company
    {
        return $this->companyRepository->update($company, $data);
    }
    
    /**
     * Delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteCompany(Company $company): ?bool
    {
        return $this->companyRepository->delete($company);
    }
    
    /**
     * Restore company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function restoreCompany(Company $company): ?bool
    {
        return $this->companyRepository->restore($company);
    }
    
    /**
     * Permanently delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function forceDeleteCompany(Company $company): ?bool
    {
        // TODO save company name somewhere and make this for all other models
        return $this->companyRepository->forceDelete($company);
    }
    
    /**
     * Get array of companies for form select
     *
     * @return array
     */
    public function getFormSelectCompanies(): array
    {
        $formSelectCompanies = [];
        $rawCompanies = $this->companyRepository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawCompanies) === 0) {
            return $formSelectCompanies;
        }
        
        foreach ($rawCompanies as $company) {
            $formSelectCompanies[$company['id']] = $company['name'];
        }
        
        return $formSelectCompanies;
    }
}
