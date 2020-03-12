<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClient;
use App\Http\Requests\Record\StoreRecord;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Services\Client\ClientService;
use App\Services\Record\RecordService;
use Carbon\Carbon;

class ClientController extends Controller
{
    protected ClientService $clientService;
    protected RecordService $recordService;

    public function __construct(ClientService $clientService, RecordService $recordService)
    {
        $this->clientService = $clientService;
        $this->recordService = $recordService;
    }

    public function list()
    {
        $currentUser = \Auth::user();
        $this->authorize(UserPolicy::CAN_VIEW_CLIENT_LIST, $currentUser);

        $masterClient = $this->clientService->getMasterClientsPagination($currentUser->id);

        return view('pages.master.user.list', [
            'clients' => $masterClient
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showCreate()
    {
        $currentUser = \Auth::user();
        $this->authorize(UserPolicy::CAN_CREATE, $currentUser);

        return view('pages.master.user.createEdit', [
            'title' => 'Создание клиента',
            'submitText' => 'Создать'
        ]);
    }

    public function create(StoreClient $request)
    {
        $currentUser = \Auth::user();
        $this->authorize(UserPolicy::CAN_CREATE, $currentUser);

        $userData = $request->only(['last_name', 'first_name', 'phone_number', 'email', 'material', 'note']);

        /** @var User $user */
        $user = $this->clientService->createClient($currentUser, $userData);

        return redirect()->to(route('master.user.detail', ['id' => $user->id]));
    }

    public function detail(int $userId)
    {
        $client = $this->clientService->getMasterClient($userId);
        $clientRecords = $this->recordService->getClientRecords($userId);

        $this->authorize('view', $client);

        return view('pages.master.user.detail', [
            'client' => $client,
            'records' => $clientRecords
        ]);
    }

    public function edit(int $userId)
    {
        $client = $this->clientService->getMasterClient($userId);

        $this->authorize('view', $client);

        return view('pages.master.user.createEdit', [
            'title' => 'Редактирование клиента',
            'submitText' => 'Сохранить',
            'client' => $client,
        ]);
    }

    public function showCreateRecord(int $clientId)
    {
        $client = $this->clientService->getMasterClient($clientId);
        $this->authorize('createRecord', $client);

        $clients = $this->clientService->getMasterClients(\Auth::id());

        return view('pages.master.record.create', [
            'clients' => $clients,
            'clientId' => $clientId
        ]);
    }

    public function createRecord(StoreRecord $storeRecordRequest)
    {
        $this->authorize('create', \Auth::user());

        // Check master-user relation
        $client = $this->clientService->getMasterClient($storeRecordRequest->post('client_id'));
        $this->authorize('update', $client);

        $recordData = $storeRecordRequest->getFormData();

        $record = $this->recordService->create($recordData);

        return redirect()->to(route('master.user.detail', ['id' => $record->client_id]));
    }
}
