<?php

namespace App\Services\Conversations;

use App\Models\Conversation;
use App\Repositories\Conversations\ConversationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ConversationService
{
    private $repository;
    
    public function __construct(ConversationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get all conversations
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allConversations($columns = []): Collection
    {
        return $this->repository->all($columns);
    }
    
    /**
     * Get paginated conversations
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateConversations(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
    
    /**
     * Paginate conversations incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateConversationsWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithTrashed($perPage);
    }
    
    /**
     * Create conversation
     *
     * @param  array  $data
     *
     * @return Conversation
     */
    public function createConversation(array $data): Conversation
    {
        return $this->repository->create($data);
    }
    
    /**
     * Find conversation by id
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function findConversation(int $id): ?Conversation
    {
        return $this->repository->find($id);
    }
    
    /**
     * Find conversation by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Conversation|null
     */
    public function findConversationWithTrashed(int $id): ?Conversation
    {
        return $this->repository->findWithTrashed($id);
    }
    
    /**
     * Update conversation
     *
     * @param  Conversation  $conversation
     * @param  array  $data
     *
     * @return Conversation
     */
    public function updateConversation(Conversation $conversation, array $data): Conversation
    {
        return $this->repository->update($conversation, $data);
    }
    
    /**
     * Delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteConversation(Conversation $conversation): ?bool
    {
        return $this->repository->delete($conversation);
    }
    
    /**
     * Restore conversation
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function restoreConversation(int $id): ?bool
    {
        $conversation = $this->findConversationWithTrashed($id);
        
        if (!$conversation) {
            return false;
        }
        
        return $this->repository->restore($conversation);
    }
    
    /**
     * Permanently delete conversation
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function forceDeleteConversation(int $id): ?bool
    {
        $conversation = $this->findConversationWithTrashed($id);
        
        if (!$conversation) {
            return false;
        }
        
        return $this->repository->forceDelete($conversation);
    }
    
    /**
     * Get array of conversations for form select
     *
     * @return array
     */
    public function getFormSelectConversations(): array
    {
        $formSelectConversations = [];
        $rawConversations = $this->repository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawConversations) === 0) {
            return $formSelectConversations;
        }
        
        foreach ($rawConversations as $conversation) {
            $formSelectConversations[$conversation['id']] = $conversation['name'];
        }
        
        return $formSelectConversations;
    }
}
