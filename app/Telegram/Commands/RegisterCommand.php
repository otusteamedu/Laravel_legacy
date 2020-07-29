<?php

namespace App\Telegram\Commands;

use App\Models\TelegramUser;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class RegisterCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'register';

    /**
     * @var string Command Description
     */
    protected $description = 'Register student ID';
    /**
     * @var TelegramUserStatus
     */
    private $telegramUserStatus;
    /**
     * @var TelegramService
     */
    private $service;

    /**
     * {@inheritdoc}
     */
    public function handle($telegram)
    {
        $this->telegramUserStatus = app(TelegramUserStatus::class);
        $this->service = app(TelegramService::class);

        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);

        $telegramUser = TelegramUser::find($telegram['from']['id']);

        $status = $this->telegramUserStatus->getAndClearStatus($telegramUser);

        if (($status === TelegramUserStatus::START_REGISTRATION) && isset($telegram['text'])) {
            if ($this->service->register($telegramUser, $telegram['text'])) {
                $this->successRegister($telegram, $telegramUser);
            } else {
                $this->failedRegister($telegram);
            }
        } else {
            $this->attemptRegister($telegram, $telegramUser);
        }
    }

    /**
     * @param $telegram
     * @param TelegramUser $telegramUser
     */
    private function attemptRegister($telegram, TelegramUser $telegramUser): void
    {
        $this->telegramUserStatus->setStatus($telegramUser, TelegramUserStatus::START_REGISTRATION);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => 'Укажи номер студенческого билета',
        ]);
    }

    /**
     * @param $telegram
     * @param TelegramUser $telegramUser
     */
    private function successRegister($telegram, TelegramUser $telegramUser):void
    {
        $keyboard = [
            ['Меню'],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => 'Добро пожаловать ' . $telegramUser->user->full_name,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * @param $telegram
     */
    private function failedRegister($telegram): void
    {
        $keyboard = [
            ['Попробовать зарегистрироваться снова'],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => 'Ошибка регистрации.(((',
            'reply_markup' => $reply_markup,
        ]);
    }
}
