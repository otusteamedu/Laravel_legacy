<?php

namespace App\Services\Leads;

use App\Models\Lead;
use App\Repositories\Leads\LeadRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LeadService
{
    private $repository;
    
    public function __construct(LeadRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get all leads
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allLeads($columns = []): Collection
    {
        return $this->repository->all($columns);
    }
    
    /**
     * Paginate leads
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateLeads(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
    
    /**
     * Paginate leads incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateLeadsWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithTrashed($perPage);
    }
    
    /**
     * Create lead
     *
     * @param  array  $data
     *
     * @return Lead
     */
    public function createLead(array $data): Lead
    {
        return $this->repository->create($data);
    }
    
    /**
     * Find lead by id
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function findLead(int $id): ?Lead
    {
        return $this->repository->find($id);
    }
    
    /**
     * Find lead by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Lead|null
     */
    public function findLeadWithTrashed(int $id): ?Lead
    {
        return $this->repository->findWithTrashed($id);
    }
    
    /**
     * Update lead
     *
     * @param  Lead  $lead
     * @param  array  $data
     *
     * @return Lead
     */
    public function updateLead(Lead $lead, array $data): Lead
    {
        return $this->repository->update($lead, $data);
    }
    
    /**
     * Delete lead
     *
     * @param  Lead  $lead
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteLead(Lead $lead): ?bool
    {
        return $this->repository->delete($lead);
    }
    
    /**
     * Restore lead
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function restoreLead(int $id): ?bool
    {
        $lead = $this->findLeadWithTrashed($id);
        
        if (!$lead) {
            return false;
        }
        
        return $this->repository->restore($lead);
    }
    
    /**
     * Permanently delete lead
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function forceDeleteLead(int $id): ?bool
    {
        $lead = $this->findLeadWithTrashed($id);
        
        if (!$lead) {
            return false;
        }
        
        return $this->repository->forceDelete($lead);
    }
    
    /**
     * Get array of leads for form select
     *
     * @return array
     */
    public function getFormSelectLeads(): array
    {
        $formSelectLeads = [];
        $rawLeads = $this->repository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawLeads) === 0) {
            return $formSelectLeads;
        }
        
        foreach ($rawLeads as $lead) {
            $formSelectLeads[$lead['id']] = $lead['name'];
        }
        
        return $formSelectLeads;
    }
}
