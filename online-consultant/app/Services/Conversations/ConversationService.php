<?php

namespace App\Services\Conversations;

use App\Models\Conversation;
use App\Repositories\Conversations\ConversationRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ConversationService
{
    private $conversationRepository;
    
    public function __construct(ConversationRepositoryInterface $conversationRepository)
    {
        $this->conversationRepository = $conversationRepository;
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
        return $this->conversationRepository->all($columns);
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
        return $this->conversationRepository->paginate($perPage);
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
        return $this->conversationRepository->paginateWithTrashed($perPage);
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
        return $this->conversationRepository->create($data);
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
        return $this->conversationRepository->find($id);
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
        return $this->conversationRepository->findWithTrashed($id);
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
        return $this->conversationRepository->update($conversation, $data);
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
        return $this->conversationRepository->delete($conversation);
    }
    
    /**
     * Restore conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function restoreConversation(Conversation $conversation): ?bool
    {
        return $this->conversationRepository->restore($conversation);
    }
    
    /**
     * Permanently delete conversation
     *
     * @param  Conversation  $conversation
     *
     * @return bool|null
     */
    public function forceDeleteConversation(Conversation $conversation): ?bool
    {
        return $this->conversationRepository->forceDelete($conversation);
    }
    
    /**
     * Get array of conversations for form select
     *
     * @return array
     */
    public function getFormSelectConversations(): array
    {
        $formSelectConversations = [];
        $rawConversations = $this->conversationRepository->getFormSelectOptions(['id', 'name']);
        
        if (count($rawConversations) === 0) {
            return $formSelectConversations;
        }
        
        foreach ($rawConversations as $conversation) {
            $formSelectConversations[$conversation['id']] = $conversation['name'];
        }
        
        return $formSelectConversations;
    }
}
