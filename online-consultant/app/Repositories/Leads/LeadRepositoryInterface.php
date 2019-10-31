<?php

namespace App\Repositories\Leads;

use App\Models\Lead;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    /**
     * Get all leads
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection;
    
    /**
     * Paginate leads
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Paginate leads incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Create lead
     *
     * @param  array  $data
     *
     * @return Lead
     */
    public function create(array $data): Lead;
    
    /**
     * Find lead by id
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function find(int $id): ?Lead;
    
    /**
     * Find lead by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function findWithTrashed(int $id): ?Lead;
    
    /**
     * Update lead
     *
     * @param  Lead  $lead
     * @param  array  $data
     *
     * @return Lead
     */
    public function update(Lead $lead, array $data): Lead;
    
    /**
     * Delete lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     */
    public function delete(Lead $lead): ?bool;
    
    /**
     * Restore lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     */
    public function restore(Lead $lead): ?bool;
    
    /**
     * Permanently delete lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     */
    public function forceDelete(Lead $lead): ?bool;
    
    /**
     * Get array of leads for form select
     *
     * @param  array  $columns
     *
     * @return Lead[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
