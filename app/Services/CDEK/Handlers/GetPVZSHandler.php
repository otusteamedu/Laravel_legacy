<?php


namespace App\Services\CDEK\Handlers;

use CdekSDK\Requests;

class GetPVZSHandler
{
    private \CdekSDK\CdekClient $client;

    public function __construct()
    {
        $this->client = new \CdekSDK\CdekClient(
            env('CDEK_ACCOUNT'),
            env('CDEK_PASSWORD'),
            new \GuzzleHttp\Client([
                'base_uri' => 'https://integration.edu.cdek.ru',
            ])
        );
    }

    /**
     * @param string $query
     * @return array
     */
    public function handle(string $query): array
    {
        $response = $this->client->sendPvzListRequest($this->getPVZSListRequest($query));

//        if ($response->hasErrors()) {
//            // обработка ошибок
//        }

        $pvzs = [];

        /** @var \CdekSDK\Responses\PvzListResponse $response */
        foreach ($response as $key => $item) {
            /** @var \CdekSDK\Common\Pvz $item */
            $pvzs[$key]['code'] = $item->Code;
            $pvzs[$key]['name'] = $item->Name;
            $pvzs[$key]['address'] = $item->Address;
            $pvzs[$key]['postal_code'] = $item->PostalCode;
            $pvzs[$key]['phones'] = $item->Phone;
        }

        return $pvzs;
    }

    private function getPVZSListRequest(string $query)
    {
        $request = new Requests\PvzListRequest();
        $request->setCityId($query);
        $request->setType(Requests\PvzListRequest::TYPE_ALL);
        $request->setCashless(true);
        $request->setCodAllowed(true);
        $request->setDressingRoom(true);

        return $request;
    }
}
