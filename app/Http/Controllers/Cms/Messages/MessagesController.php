<?php

namespace App\Http\Controllers\Cms\Messages;

use App\Http\Controllers\Cms\Messages\Request\StoreMessageRequest;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Services\Messages\MessagesService;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $messageService;

    public function __construct(MessagesService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messageList = $this->messageService->showMessageList();
        return view('cms.messages.index', ['messageList'=>$messageList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        $data = $request->getFormData();
        $this->messageService->storeMessage($data);

        return redirect()->back()->with('success', 'Добавлено'); //redirect(route('messages.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('cms.messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Message $message
     * @return void
     */
    public function edit(Message $message)
    {
        return view('cms.messages.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreMessageRequest $request
     * @param Message $message
     * @return void
     */
    public function update(StoreMessageRequest $request, Message $message)
    {
        $this->messageService->updateMessage($message, $request->all());
        return redirect()->back()->with('success', 'Обновлено'); //redirect(route('messages.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->messageService->deleteMessage($message);

        return redirect()->back()->with('success', 'Удалено'); //redirect(route('messages.index'));
    }
}
