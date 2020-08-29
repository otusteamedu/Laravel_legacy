<?php

namespace App\Http\Controllers\Telegram;

use App\DTOs\TelegramCommandDTO;
use App\DTOs\TelegramMessageDTO;
use App\Http\Controllers\Controller;
use App\Services\Telegram\Exceptions\TelegramException;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
use App\Telegram\Commands\ErrorCommand;
use App\Telegram\Commands\RegisterCommand;
use Exception;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class TelegramController
 * @package App\Http\Controllers\Telegram
 */
class TelegramController extends Controller
{
    /**
     * @var TelegramService
     */
    private $service;
    /**
     * @var RegisterCommand
     */
    private $registerCommand;
    /**
     * @var TelegramUserStatus
     */
    private $status;

    /**
     * TelegramController constructor.
     * @param TelegramService $service
     * @param RegisterCommand $registerCommand
     * @param TelegramUserStatus $status
     */
    public function __construct(
        TelegramService $service,
        RegisterCommand $registerCommand,
        TelegramUserStatus $status
    ) {
        $this->service = $service;
        $this->registerCommand = $registerCommand;
        $this->status = $status;
    }

    public function webhook(): void
    {
        try {
            $telegramMessageDTO = TelegramMessageDTO::fromArray(
                json_decode(Telegram::getWebhookUpdates()['message'], true)
            );

            if (!($telegramUser = $this->service->findById($telegramMessageDTO->toArray()['from']['id']))) {
                $telegramUser = $this->service->store($telegramMessageDTO->toArray()['from']);
            }

            /**
             * Регистрация пользователя
             */
            if (!$telegramUser->user_id) {
                try {
                    $this->registerCommand->handle($telegramMessageDTO);
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                }

                return;
            }

            /**
             * Вызываем команду по алиас
             */
            if ($command = $this->service->getCommandByCommandName($telegramMessageDTO->toArray()['text'])) {
                $this->status->getAndClearStatus($telegramUser);
                resolve($command)->handle(TelegramCommandDTO::fromArray([
                    TelegramCommandDTO::TELEGRAM_MESSAGE_DTO => $telegramMessageDTO,
                    TelegramCommandDTO::TELEGRAM_USER => $telegramUser,
                ]));

                return;
            }

            /**
             * Вызываем команду по статусу
             */
            if ($status = $this->status->getAndClearStatus($telegramUser)) {
                resolve($this->service->getCommandByStatus($status))->handle(TelegramCommandDTO::fromArray([
                    TelegramCommandDTO::TELEGRAM_MESSAGE_DTO => $telegramMessageDTO,
                    TelegramCommandDTO::TELEGRAM_USER => $telegramUser,
                ]));

                return;
            }

            Telegram::commandsHandler(true);
        } catch (TelegramException $telegramException) {
            Log::channel('telegram_errors')->error($this->prepareLogData($telegramException));
            resolve(ErrorCommand::class)->handle($telegramMessageDTO ?? null);
        } catch (Exception $exception) {
            Log::error($this->prepareLogData($exception));
            resolve(ErrorCommand::class)->handle($telegramMessageDTO ?? null);
        }
    }

    /**
     * @param Exception $e
     * @return array
     */
    private function prepareLogData(Exception $e): array
    {
        return [
            'date' => date('Y-m-d H:i:s'),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ];
    }
}
