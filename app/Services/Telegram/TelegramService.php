<?php

namespace App\Services\Telegram;

use App\DTOs\TelegramUserDTO;
use App\Models\Post;
use App\Models\TelegramUser;
use App\Services\Telegram\Exceptions\TelegramException;
use App\Services\Telegram\Handlers\CreateTelegramUserHandler;
use App\Services\Telegram\Handlers\RegisterTelegramUserHandler;
use App\Services\Telegram\Handlers\UpdateTelegramUserHandler;
use App\Services\Telegram\Repositories\TelegramRepositoryInterface;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Telegram\Commands\MenuCommand;
use App\Telegram\Commands\GetGroupsCommand;
use App\Telegram\Commands\SetDefaultGroupCommand;
use App\Telegram\Commands\SettingsCommand;
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
    ) {
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
     * @return array
     */
    public function getCommands(): array
    {
        return [
            __('telegram.set_group') => GetGroupsCommand::class,
            __('telegram.menu') => MenuCommand::class,
            __('telegram.settings') => SettingsCommand::class,
        ];
    }

    /**
     * @param string $commandName
     * @return string|null
     */
    public function getCommandByCommandName(string $commandName): ?string
    {
        return $this->getCommands()[$commandName] ?? null;
    }

    /**
     * @param int $status
     * @return string
     */
    public function getCommandByStatus(int $status): string
    {
        switch ($status) {
            case TelegramUserStatus::SET_GROUP:
                return SetDefaultGroupCommand::class;
        }

        throw new TelegramException($status . ' not exist.');
    }

    /**
     * @param string $url
     * @return string
     * @throws GuzzleException
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
     * @param TelegramUserDTO $telegramUserDTO
     * @param TelegramUser $telegramUser
     * @return TelegramUser
     */
    public function update(TelegramUserDTO $telegramUserDTO, TelegramUser $telegramUser): TelegramUser
    {
        return $this->updateTelegramUserHandler->handle($telegramUserDTO, $telegramUser);
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

    /**
     * @param int $id
     * @return TelegramUser|null
     */
    public function findById(int $id): ?TelegramUser
    {
        return $this->repository->findById($id);
    }
}
