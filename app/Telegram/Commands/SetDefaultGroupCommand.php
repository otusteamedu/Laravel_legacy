<?php

namespace App\Telegram\Commands;

use App\DTOs\TelegramCommandDTO;
use App\DTOs\TelegramMessageDTO;
use App\DTOs\TelegramUserDTO;
use App\Models\TelegramUser;
use App\Services\Groups\GroupService;
use App\Services\Telegram\TelegramService;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class SetDefaultGroupCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'set_default_group';

    /**
     * @var string Command Description
     */
    protected $description = 'Set default student group';
    /**
     * @var TelegramService
     */
    private $service;

    /**
     * @var TelegramCommandDTO $telegramCommand
     */
    public function handle($telegramCommand)
    {
        $this->service = app(TelegramService::class);
        $groupService = app(GroupService::class);
        $telegramMessage = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_MESSAGE_DTO]->toArray();
        /** @var TelegramUser $telegramUser */
        $telegramUser = $telegramCommand->toArray()[TelegramCommandDTO::TELEGRAM_USER];

        $groupId = (int)$telegramMessage[TelegramMessageDTO::TEXT];

        if ($group = $groupService->getByNumber($groupId)) {
            Log::channel('telegram_info')->debug($group->toArray());
            $dto = TelegramUserDTO::fromArray(array_merge(
                $telegramUser->toArray(),
                [TelegramUserDTO::DEFAULT_GROUP => $group->id]
            ));
            $telegramUser = $this->service->update($dto, $telegramUser);
        }

        $keyboard = [
            [__('telegram.set_group')],
            [__('telegram.menu')],
        ];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
        ]);

        Telegram::sendMessage([
            'chat_id' => $telegramMessage['from']['id'],
            'text' => $telegramUser->group->number ?? __('telegram.no_available_groups'),
            'reply_markup' => $reply_markup,
        ]);
    }
}
