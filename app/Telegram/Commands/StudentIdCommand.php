<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class StudentIdCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'Settings';

    /**
     * @var string Command Description
     */
    protected $description = 'Set student_id';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        /** БОТ набирает в чате */
        $this->replyWithChatAction([
            'action' => Actions::TYPING,
        ]);


        $keyboard = [
            ['/test'],    // первая строка клавиатуры
        ];

        $telegram_user = Telegram::getWebhookUpdates()['message'];

        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,    // массив кнопок
            'resize_keyboard' => true,  // не меняется по вертикали для оптимальной подгонки
            'one_time_keyboard' => true // исчезает после использования
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => $telegram_user['from']['id'],
            'text' => 'Введите номер студенческого билета',
            'reply_markup' => $reply_markup
        ]);

        $messageId = $response->getMessageId(); // id последнего отправленного сообщения
        Log::notice($messageId);
    }
}
