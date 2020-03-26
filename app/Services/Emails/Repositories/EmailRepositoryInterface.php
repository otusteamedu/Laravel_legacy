<?php


namespace App\Services\Emails\Repositories;

use App\Models\Email;
use App\Models\User;

interface EmailRepositoryInterface
{
    /**
     * @param User $user
     * @param string $template_name шаблон письма или тип письма
     * @return Email письмо по шаблону(типу) $template_name, для пользователя $user, которое ещё не отправлен
     */
    public function getNewEmailForUser(User $user, string $template_name):Email;

    /**
     * @param Email $email
     * @param int $status новый статус письма
     */
    public function setEmailStatus(Email $email, int $status):void;
}
