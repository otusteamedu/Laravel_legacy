<?php


namespace App\Services\Emails\Handlers;

use App\Models\Email;
use App\Models\User;

class CreateEmailHandler
{

    public function __construct()
    {

    }

    /**
     * @param User $user пользователь, для которого будет создано письмо
     * @param string $template_name название email-рассылки = шаблон письма
     * @return void
     */
    public function handle(User $user, string $template_name):void
    {
        $email = factory(Email::class)->create([
            'user_id' => $user->id,
            'template' => $template_name,
            'status' => Email::STATUS_NEW
        ]);
        $email->save();
    }
}
