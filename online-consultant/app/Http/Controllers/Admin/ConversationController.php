<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Conversations\StoreConversation;
use App\Http\Requests\Conversations\UpdateConversation;
use App\Models\Conversation;
use App\Policies\Abilities;
use App\Services\Conversations\ConversationService;
use App\Traits\Auth\HasAuthorizationPolicy;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ConversationController extends Controller
{
    use HasAuthorizationPolicy;
    
    protected $modelClass = Conversation::class;
    
    private $conversationService;
    
    public function __construct(ConversationService $conversationService) {
        $this->conversationService = $conversationService;
    
        $this->viewShareData();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|RedirectResponse|View
     */
    public function index()
    {
        if (!$this->authorizeUserAbility(Abilities::VIEW_ANY)) {
            return $this->redirectIfNoPermission('admin.dashboard', Abilities::VIEW_ANY);
        }
        
        $conversations = $this->conversationService->paginateConversationsWithTrashed();
        
        return view('admin.models.conversations.index', compact('conversations'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreConversation  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreConversation $request): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::CREATE)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::CREATE);
        }
        
        $this->conversationService->createConversation($request->all());
        
        return redirect()->route('admin.conversations.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Conversation  $conversation
     *
     * @return Factory|RedirectResponse|View
     */
    public function edit(Conversation $conversation)
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $conversation)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::UPDATE);
        }
        
        return view('admin.models.conversations.edit', compact('conversation'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateConversation  $request
     * @param  Conversation  $conversation
     *
     * @return RedirectResponse
     */
    public function update(UpdateConversation $request, Conversation $conversation): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::UPDATE, $conversation)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::UPDATE);
        }
        
        $this->conversationService->updateConversation($conversation, $request->all());
        
        return redirect()->route('admin.conversations.edit', compact('conversation'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Conversation  $conversation
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Conversation $conversation): RedirectResponse
    {
        if (!$this->authorizeUserAbility(Abilities::DELETE, $conversation)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::DELETE);
        }
        
        $this->conversationService->deleteConversation($conversation);
        
        return redirect()->route('admin.conversations.index');
    }
    
    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $conversation = $this->conversationService->findConversationWithTrashed($id);
    
        if (!$conversation) {
            return redirect()->route('admin.conversations.index')->with('errors', __('admin.conversations.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::RESTORE, $conversation)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::RESTORE);
        }
        
        $this->conversationService->restoreConversation($conversation);
        
        return redirect()->route('admin.conversations.index');
    }
    
    /**
     * Permanently delete the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function forceDelete(int $id): RedirectResponse
    {
        $conversation = $this->conversationService->findConversationWithTrashed($id);
    
        if (!$conversation) {
            return redirect()->route('admin.conversations.index')->with('errors', __('admin.conversations.errors.not_found'));
        }
        
        if (!$this->authorizeUserAbility(Abilities::FORCE_DELETE, $conversation)) {
            return $this->redirectIfNoPermission('admin.conversations.index', Abilities::FORCE_DELETE);
        }
        
        $this->conversationService->forceDeleteConversation($conversation);
        
        return redirect()->route('admin.conversations.index');
    }
}
