<?php


namespace App\Services\Messages\Handler;

use App\Services\Messages\MessagesService;


class AddMessageToAnyAdvertsHandler
{
    /**
     * @var MessagesService
     */
    private $messageService;

    public function __construct(MessagesService $messageService )
    {
        $this->messageService = $messageService;
    }

    public function handle($message, $adverts, $isAdmin)
    {
        foreach ($adverts as $advert)
        {
             $data = $this->prepareData($isAdmin, $advert, $message);
             $this->messageService->storeMessage($data);
        }
    }


    private function prepareData($isAdmin, $advert, $message)
    {
        return $data =
            [
               'user_id'=>$isAdmin,
               'advert_id'=>$advert,
               'content'=>$message,
            ];
    }



}
