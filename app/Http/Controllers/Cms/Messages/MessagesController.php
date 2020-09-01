<?php

namespace App\Http\Controllers\Cms\Messages;

use App\Http\Controllers\Cms\Messages\Request\StoreMessageRequest;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Services\Messages\MessagesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index()
    {
        $messageList = $this->messageService->showMessageList();
        return view('cms.messages.index', ['messageList'=>$messageList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
     * @return Response
     */
    public function show(Message $message)
    {
        return view('cms.messages.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Message $message
     * @param Request $request
     * @return void
     */
    public function edit(Message $message, Request $request)
    {
        return view('cms.messages.edit', ['message' => $message, 'url'=>url()->previous()]);
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
        //return redirect()->back()->with('success', 'Обновлено');
        return redirect($request->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return Response
     */
    public function destroy(Message $message)
    {
        $this->messageService->deleteMessage($message);

        return redirect()->back()->with('success', 'Удалено'); //redirect(route('messages.index'));
    }
}
