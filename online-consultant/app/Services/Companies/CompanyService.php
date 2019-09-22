<?php

namespace App\Services\Companies;

use App\Models\Company;
use App\Repositories\Companies\CompanyRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CompanyService
{
    private $repository;
    
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        return $this->repository->all($columns);
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
        return $this->repository->paginate($perPage);
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
        return $this->repository->paginateWithTrashed($perPage);
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
        return $this->repository->create($data);
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
        return $this->repository->find($id);
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
        return $this->repository->findWithTrashed($id);
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
        return $this->repository->update($company, $data);
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
        return $this->repository->delete($company);
    }
    
    /**
     * Restore company
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function restoreCompany(int $id): ?bool
    {
        $company = $this->findCompanyWithTrashed($id);
        
        if (!$company) {
            return false;
        }
        
        return $this->repository->restore($company);
    }
    
    /**
     * Permanently delete company
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function forceDeleteCompany(int $id): ?bool
    {
        $company = $this->findCompanyWithTrashed($id);
        
        if (!$company) {
            return false;
        }
        
        // TODO save company name somewhere and make this for all other models
        return $this->repository->forceDelete($company);
    }
    
    /**
     * Get array of companies for form select
     *
     * @return array
     */
    public function getFormSelectCompanies(): array
    {
        $formSelectCompanies = [];
        $rawCompanies = $this->repository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawCompanies) === 0) {
            return $formSelectCompanies;
        }
        
        foreach ($rawCompanies as $company) {
            $formSelectCompanies[$company['id']] = $company['name'];
        }
        
        return $formSelectCompanies;
    }
}
