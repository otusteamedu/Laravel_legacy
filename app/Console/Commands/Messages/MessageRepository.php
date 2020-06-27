<?php


namespace App\Console\Commands\Messages;

use App\Services\Messages\MessagesService;

class MessageRepository
{

    public static function addMessage($message, $adverts, $isAdmin, MessagesService $messageService )
    {
        $isAdmin==null ? $isAdmin=2 : $isAdmin;
        foreach ($adverts as $advert)
        {
             $data = self::data($isAdmin, $advert, $message);
           return $messageService->storeMessage($data);
        }
    }

    public static function data($isAdmin, $advert, $message)
    {
        return $data =
            [
               'user_id'=>$isAdmin,
               'advert_id'=>$advert,
               'content'=>$message,
            ];
    }
}
