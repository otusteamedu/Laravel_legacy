<?php

namespace App\Repositories\Conversations;

use App\Models\Conversation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentConversationRepository implements ConversationRepositoryInterface
{
    /**
     * Get all conversations
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = []): Collection
    {
        return Conversation::all($columns);
    }
    
    /**
     * Paginate conversations
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
     * Paginate conversations incl. trashed
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
     * @return Conversation|Builder
     */
    public function withRelations()
    {
        return Conversation::with(['company', 'manager', 'lead', 'widget']);
    }
    
    /**
     * Create conversation
     *
     * @param  array  $data
     *
     * @return Conversation
     */
    public function create(array $data): Conversation
    {
        $conversation = new Conversation();
        $conversation->fill($data);
        $conversation->save();
        
        return $conversation;
    }
    
    /**
     * Find conversation by id
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function find(int $id): ?Conversation
    {
        return Conversation::find($id);
    }
    
    /**
     * Find conversation by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function findWithTrashed(int $id): ?Conversation
    {
        return Conversation::withTrashed()->find($id);
    }
    
    /**
     * Update conversation
     *
     * @param  Conversation  $conversation
     * @param  array  $data
     *
     * @return Conversation
     */
    public function update(Conversation $conversation, array $data): Conversation
    {
        $conversation->update($data);
        
        return $conversation;
    }
    
    /**
     * Delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Conversation $conversation): ?bool
    {
        return $conversation->delete();
    }
    
    /**
     * Restore conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function restore(Conversation $conversation): ?bool
    {
        return $conversation->restore();
    }
    
    /**
     * Permanently delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function forceDelete(Conversation $conversation): ?bool
    {
        return $conversation->forceDelete();
    }
    
    /**
     * Get array of conversations for form select
     *
     * @param  array  $columns
     *
     * @return Conversation[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
