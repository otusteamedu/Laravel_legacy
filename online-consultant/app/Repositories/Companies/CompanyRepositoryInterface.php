<?php

namespace App\Repositories\Companies;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    /**
     * Get all companies
     *
     * @param  array  $columns
     *
     * @return Company[]|Collection
     */
    public function all($columns = []);
    
    /**
     * Paginate companies
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Paginate companies incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Create company
     *
     * @param  array  $data
     *
     * @return Company
     */
    public function create(array $data): Company;
    
    /**
     * Find company by id
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function find(int $id): ?Company;
    
    /**
     * Find company by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function findWithTrashed(int $id): ?Company;
    
    /**
     * Update company
     *
     * @param  Company  $company
     * @param  array  $data
     *
     * @return Company
     */
    public function update(Company $company, array $data): Company;
    
    /**
     * Delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Company $company): ?bool;
    
    /**
     * Restore company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function restore(Company $company): ?bool;
    
    /**
     * Permanently delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function forceDelete(Company $company): ?bool;
    
    /**
     * Get array of companies for form select
     *
     * @param  array  $columns
     *
     * @return Company[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
