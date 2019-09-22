<?php

namespace App\Repositories\Conversations;

use App\Models\Conversation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ConversationRepositoryInterface
{
    /**
     * Get all conversations
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = []): Collection;
    
    /**
     * Paginate conversations
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Paginate conversations incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Create conversation
     *
     * @param  array  $data
     *
     * @return Conversation
     */
    public function create(array $data): Conversation;
    
    /**
     * Find conversation by id
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function find(int $id): ?Conversation;
    
    /**
     * Find conversation by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function findWithTrashed(int $id): ?Conversation;
    
    /**
     * Update conversation
     *
     * @param  Conversation  $conversation
     * @param  array  $data
     *
     * @return Conversation
     */
    public function update(Conversation $conversation, array $data): Conversation;
    
    /**
     * Delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function delete(Conversation $conversation): ?bool;
    
    /**
     * Restore conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function restore(Conversation $conversation): ?bool;
    
    /**
     * Permanently delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function forceDelete(Conversation $conversation): ?bool;
    
    /**
     * Get array of conversations for form select
     *
     * @param  array  $columns
     *
     * @return Conversation[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
