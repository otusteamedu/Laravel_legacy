<?php

namespace App\Http\Controllers;

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

    public function edit(int $recordId)
    {
        $record = $this->recordService->getRecord($recordId);
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
}
