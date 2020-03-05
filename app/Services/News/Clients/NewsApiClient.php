<?php
/**
 * Description of NewsApiClient.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\News\Clients;


use Carbon\Carbon;

class NewsApiClient implements NewsClientInterface
{

    const LIST_URL_TEMPLATE = 'https://newsapi.org/v2/everything?q=bitcoin&from=%s&sortBy=publishedAt&apiKey=%s';

    public function latest(): array
    {
        return json_decode(file_get_contents(
            $this->generateLatestUrl()
        ), true);
    }

    private function generateLatestUrl()
    {
        return sprintf(
            self::LIST_URL_TEMPLATE,
            Carbon::now()->format('Y-d-m'),
            config('services.news_api.api_key')
        );
    }

}
