<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Conversations\StoreConversation;
use App\Http\Requests\Conversations\UpdateConversation;
use App\Models\Conversation;
use App\Services\Companies\CompanyService;
use App\Services\Conversations\ConversationService;
use App\Services\Leads\LeadService;
use App\Services\Users\UserService;
use App\Services\Widgets\WidgetService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ConversationController extends Controller
{
    private $conversationService;
    private $leadService;
    private $widgetService;
    private $userService;
    private $companyService;
    
    public function __construct(
        ConversationService $conversationService,
        LeadService $leadService,
        WidgetService $widgetService,
        UserService $userService,
        CompanyService $companyService
    ) {
        $this->conversationService = $conversationService;
        $this->leadService = $leadService;
        $this->widgetService = $widgetService;
        $this->userService = $userService;
        $this->companyService = $companyService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $conversations = $this->conversationService->paginateConversationsWithTrashed();
        
        return view('admin.models.conversations.index', compact('conversations'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $leadsSelectList = $this->leadService->getFormSelectLeads();
        $widgetsSelectList = $this->widgetService->getFormSelectWidgets();
        $usersSelectList = $this->userService->getFormSelectUsers();
        $companiesSelectList = $this->companyService->getFormSelectCompanies();
        
        return view('admin.models.conversations.create',
            compact('leadsSelectList', 'widgetsSelectList', 'usersSelectList', 'companiesSelectList'));
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
        $this->conversationService->createConversation($request->all());
        
        return redirect()->route('admin.conversations.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Conversation  $conversation
     *
     * @return Factory|View
     */
    public function edit(Conversation $conversation)
    {
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
        $this->conversationService->restoreConversation($id);
        
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
        $this->conversationService->forceDeleteConversation($id);
        
        return redirect()->route('admin.conversations.index');
    }
}
