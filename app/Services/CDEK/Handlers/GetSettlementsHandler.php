<?php


namespace App\Services\CDEK\Handlers;


use Illuminate\Support\Facades\Http;

class GetSettlementsHandler
{
    private int $countryId;

    /**
     * GetSettlementsHandler constructor.
     */
    public function __construct()
    {
        $this->countryId = config('cdek.country_id');
    }

    /**
     * @param string $query
     * @return array
     */
    public function handle(string $query): array
    {
        $settlements = [];

        $url = 'https://api.cdek.ru/city/getListByTerm/jsonp.php?q=' . $query;

        $response = Http::get($url);

        if (isset($response['geonames'])) {
            $settlements = $this->getRuRegions($response['geonames']);
        }

        return array_values($settlements);
    }

    /**
     * @param array $regions
     * @return array
     */
    private function getRuRegions (array $regions): array
    {
        return array_filter($regions, function (array $region) {
            return (int) $region['countryId'] === (int) $this->countryId;
        });
    }
}
