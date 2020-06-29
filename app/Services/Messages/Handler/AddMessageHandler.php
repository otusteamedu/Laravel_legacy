<?php


namespace App\Services\Messages\Handler;

use App\Services\Messages\MessagesService;
use Illuminate\Support\Facades\Validator;

class AddMessageHandler
{

    const USER = 2;
    /**
     * @var MessagesService
     */
    private $messageService;

    public function __construct(MessagesService $messageService )
    {
        $this->messageService = $messageService;
    }

    public function addMessageToAnyAdverts($message, $adverts, $isAdmin)
    {
        $this->validate($message, $adverts, $isAdmin );

        foreach ($adverts as $advert)
        {
             $data = $this->data($isAdmin, $advert, $message);
             $this->messageService->storeMessage($data);
        }
    }


    public function data($isAdmin, $advert, $message)
    {
        if ($isAdmin==0)  $isAdmin = self::USER ;

        return $data =
            [
               'user_id'=>$isAdmin,
               'advert_id'=>$advert,
               'content'=>$message,
            ];
    }


    public function validate($message, $adverts, $isAdmin )
    {
        $input = [
            'message'  => $message,
            'adverts' => $adverts,
            'isAdmin' => $isAdmin,
        ];

        $rules = [
            'message'  => 'required|max:200',
            'adverts' => 'array|required',
            'adverts.*'=>'integer',
            'isAdmin' => 'in:0,1',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
            echo'Not valid command params'.PHP_EOL;
            die;
        }
    }
}
