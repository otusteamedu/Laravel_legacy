<?php

namespace App\Http\Controllers;

use App\Http\Requests\Record\StoreRecord;
use App\Services\Client\ClientService;
use App\Services\Record\RecordService;
use Auth;

class RecordController extends Controller
{
    protected RecordService $recordService;
    protected ClientService $clientService;

    public function __construct(RecordService $recordService, ClientService $clientService)
    {
        $this->recordService = $recordService;
        $this->clientService = $clientService;
    }

    public function list()
    {
        $currentUser = Auth::user();
        $this->authorize('viewRecordList', $currentUser);

        $masterRecords = $this->recordService->getMasterRecords($currentUser->id);

        return view('pages.master.record.list', [
            'masterRecords' => $masterRecords
        ]);
    }

    /**
     * @param int $recordId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showEdit(int $recordId)
    {
        $record = $this->recordService->get($recordId);
        $this->authorize('update', $record);

        $clients = $this->clientService->getMasterClients(Auth::id());

        return view('pages.master.record.edit',
            [
                'record' => $record,
                'clients' => $clients,
                'clientId' => $record->client_id
            ]
        );
    }

    public function edit(StoreRecord $storeRecordRequest, int $recordId)
    {
        $record = $this->recordService->get($recordId);
        $this->authorize('update', $record);

        $record = $this->recordService->update($recordId, $storeRecordRequest->getFormData());

        return redirect()->to(route('master.user.detail', ['id' => $record->client_id]));
    }
}
