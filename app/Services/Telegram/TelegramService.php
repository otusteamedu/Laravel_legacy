<?php

namespace App\Services\Telegram;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class TelegramService
 * @package App\Services\Telegram
 */
class TelegramService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * TelegramService constructor.
     */
    public function __construct()
    {
        $client = new Client([
            'base_uri' => 'https://api.telegram.org/bot' . Telegram::getAccessToken() . '/',
        ]);
        $this->client = $client;
    }

    /**
     * @param string $url
     * @return string
     */
    public function setWebhook(string $url): string
    {
        $params = [
            'query' => [
                'url' => $url . '/' . Telegram::getAccessToken()
            ]
        ];
        $result = $this->sendTelegramData(
            'setWebhook',
            $params
        );

        return $result;
    }

    /**
     * @return string
     */
    public function getWebhookInfo(): string
    {
        return $this->sendTelegramData('getWebhookInfo');
    }

    /**
     * @param string $route
     * @param array $params
     * @param string $method
     * @return string
     * @throws GuzzleException
     */
    private function sendTelegramData($route = '', $params = [], $method = 'POST'): string
    {
        try {
            $result = $this->client->request($method, $route, $params);

            /** формат string обязателен */
            return (string)$result->getBody();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
