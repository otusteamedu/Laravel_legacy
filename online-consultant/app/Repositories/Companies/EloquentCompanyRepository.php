<?php

namespace App\Repositories\Companies;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentCompanyRepository implements CompanyRepositoryInterface
{
    /**
     * Get all companies
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        return Company::all($columns);
    }
    
    /**
     * Paginate companies
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withRelations()->paginate($perPage);
    }
    
    /**
     * Paginate companies incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withRelations()->withTrashed()->paginate($perPage);
    }
    
    /**
     * Eager loading for all relations
     *
     * @return Company|Builder
     */
    public function withRelations()
    {
        return Company::with(['createdUser']);
    }
    
    /**
     * Create company
     *
     * @param  array  $data
     *
     * @return Company
     */
    public function create(array $data): Company
    {
        $company = new Company();
        $company->fill($data);
        $company->save();
        
        return $company;
    }
    
    /**
     * Find company by id
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function find(int $id): ?Company
    {
        return Company::find($id);
    }
    
    /**
     * Find company by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Company|null
     */
    public function findWithTrashed(int $id): ?Company
    {
        return Company::withTrashed()->find($id);
    }
    
    /**
     * Update company
     *
     * @param  Company  $company
     * @param  array  $data
     *
     * @return Company
     */
    public function update(Company $company, array $data): Company
    {
        $company->update($data);
        
        return $company;
    }
    
    /**
     * Delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Company $company): ?bool
    {
        return $company->delete();
    }
    
    /**
     * Restore company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function restore(Company $company): ?bool
    {
        return $company->restore();
    }
    
    /**
     * Permanently delete company
     *
     * @param  Company  $company
     *
     * @return bool|null
     */
    public function forceDelete(Company $company): ?bool
    {
        return $company->forceDelete();
    }
    
    /**
     * Get array of companies for form select
     *
     * @param  array  $columns
     *
     * @return Company[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
