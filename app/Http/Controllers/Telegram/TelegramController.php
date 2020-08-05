<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\TelegramUser;
use App\Services\Telegram\TelegramService;
use App\Telegram\Commands\RegisterCommand;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

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
     * TelegramController constructor.
     * @param TelegramService $service
     * @param RegisterCommand $registerCommand
     */
    public function __construct(
        TelegramService $service,
        RegisterCommand $registerCommand
    ) {
        $this->service = $service;
        $this->registerCommand = $registerCommand;
    }

    public function webhook(): void
    {
        $telegram = json_decode(Telegram::getWebhookUpdates()['message'], true);

        if (!($telegramUser = TelegramUser::find($telegram['from']['id']))) {
            $telegramUser = $this->service->store($telegram['from']);
        }

        if (!$telegramUser->user_id) {
            try {
                $this->registerCommand->handle($telegram);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }

            return;
        }

        Telegram::commandsHandler(true);
    }
}
