<?php

namespace App\Repositories\Leads;

use App\Models\Lead;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentLeadRepository implements LeadRepositoryInterface
{
    /**
     * Get all leads
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        return Lead::all($columns);
    }
    
    /**
     * Paginate leads
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
     * Paginate leads incl. trashed
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
        return Lead::with(['company', 'createdUser']);
    }
    
    /**
     * Create lead
     *
     * @param  array  $data
     *
     * @return Lead
     */
    public function create(array $data): Lead
    {
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();
        
        return $lead;
    }
    
    /**
     * Find lead by id
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function find(int $id): ?Lead
    {
        return Lead::find($id);
    }
    
    /**
     * Find lead by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function findWithTrashed(int $id): ?Lead
    {
        return Lead::withTrashed()->find($id);
    }
    
    /**
     * Update lead
     *
     * @param  Lead  $lead
     * @param  array  $data
     *
     * @return Lead
     */
    public function update(Lead $lead, array $data): Lead
    {
        $lead->update($data);
        
        return $lead;
    }
    
    /**
     * Delete lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Lead $lead): ?bool
    {
        return $lead->delete();
    }
    
    /**
     * Restore lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     */
    public function restore(Lead $lead): ?bool
    {
        return $lead->restore();
    }
    
    /**
     * Permanently delete lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     */
    public function forceDelete(Lead $lead): ?bool
    {
        return $lead->forceDelete();
    }
    
    /**
     * Get array of leads for form select
     *
     * @param  array  $columns
     *
     * @return Lead[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
