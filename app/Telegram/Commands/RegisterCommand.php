<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramMessageDTO;
use App\Models\TelegramUser;
use App\Services\Telegram\Statuses\TelegramUserStatus;
use App\Services\Telegram\TelegramService;
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
     * @var TelegramMessageDTO $telegramMessageDTO
     */
    public function handle($telegramMessageDTO)
    {
        $this->telegramUserStatus = app(TelegramUserStatus::class);
        $this->service = app(TelegramService::class);
        $telegram = $telegramMessageDTO->toArray();

        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);

        $telegramUser = $this->service->findById($telegram['from']['id']);

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

        Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => __('telegram.set_id'),
        ]);
    }

    /**
     * @param $telegram
     * @param TelegramUser $telegramUser
     */
    private function successRegister($telegram, TelegramUser $telegramUser):void
    {
        $keyboard = [
            [__('telegram.menu')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => __('telegram.hello') . $telegramUser->user->full_name,
            'reply_markup' => $reply_markup,
        ]);
    }

    /**
     * @param $telegram
     */
    private function failedRegister($telegram): void
    {
        $keyboard = [
            [__('telegram.try_register_again')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegram['from']['id'],
            'text' => __('telegram.register_fail'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
