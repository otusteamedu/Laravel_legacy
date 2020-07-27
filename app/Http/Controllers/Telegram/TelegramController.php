<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function webhook()
    {
        $telegram = Telegram::getWebhookUpdates()['message'];
        Log::info(json_decode($telegram, true));

        if (!TelegramUser::find($telegram['from']['id'])) {
            $telegramUser = TelegramUser::firstOrCreate(json_decode($telegram['from'], true));
            $telegramUser->user_id = 1;
            $telegramUser->save();
        }

        $text = json_decode($telegram['from'], true);
        if ($text === 'Настройки') {
            //
        }

        /** обработчик команд */
        Telegram::commandsHandler(true);
    }
}
