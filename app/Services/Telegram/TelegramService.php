<?php

namespace App\Services\Telegram;

use App\Models\Post;
use App\Models\TelegramUser;
use App\Services\Telegram\Handlers\CreateTelegramUserHandler;
use App\Services\Telegram\Handlers\RegisterTelegramUserHandler;
use App\Services\Telegram\Handlers\UpdateTelegramUserHandler;
use App\Services\Telegram\Repositories\TelegramRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
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
     * @var TelegramRepositoryInterface
     */
    private $repository;
    /**
     * @var CreateTelegramUserHandler
     */
    private $createTelegramUserHandler;
    /**
     * @var UpdateTelegramUserHandler
     */
    private $updateTelegramUserHandler;
    /**
     * @var RegisterTelegramUserHandler
     */
    private $registerTelegramUserHandler;

    /**
     * TelegramService constructor.
     * @param TelegramRepositoryInterface $repository
     * @param CreateTelegramUserHandler $createTelegramUserHandler
     * @param UpdateTelegramUserHandler $updateTelegramUserHandler
     * @param RegisterTelegramUserHandler $registerTelegramUserHandler
     */
    public function __construct(
        TelegramRepositoryInterface $repository,
        CreateTelegramUserHandler $createTelegramUserHandler,
        UpdateTelegramUserHandler $updateTelegramUserHandler,
        RegisterTelegramUserHandler $registerTelegramUserHandler
    )
    {
        $client = new Client([
            'base_uri' => 'https://api.telegram.org/bot' . Telegram::getAccessToken() . '/',
        ]);
        $this->client = $client;
        $this->repository = $repository;
        $this->createTelegramUserHandler = $createTelegramUserHandler;
        $this->updateTelegramUserHandler = $updateTelegramUserHandler;
        $this->registerTelegramUserHandler = $registerTelegramUserHandler;
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

    /**
     * @param array $data
     * @return TelegramUser
     */
    public function store(array $data): TelegramUser
    {
        return $this->createTelegramUserHandler->handle($data);
    }

    /**
     * @param TelegramUser $telegramUser
     * @param $IdNumber
     * @return TelegramUser|null
     */
    public function register(TelegramUser $telegramUser, $IdNumber): ?TelegramUser
    {
        return $this->registerTelegramUserHandler->handle($telegramUser, $IdNumber);
    }

    public function getTelegramUsersByGroupsInPost(Post $post): Collection
    {
        return $this->repository->getTelegramUsersByGroupsInPost($post);
    }
}
