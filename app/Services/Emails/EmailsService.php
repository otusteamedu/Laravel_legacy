<?php


namespace App\Services\Emails;

use App\Models\Email;
use App\Models\User;
use App\Services\Emails\Handlers\CreateEmailHandler;
use App\Services\Emails\Handlers\EmailSentHandler;
use App\Services\Emails\Repositories\EmailRepositoryInterface;

class EmailsService
{
    private $emailRepository;
    private $createEmailHandler;
    private $emailSentHandler;

    public function __construct(EmailRepositoryInterface $emailRepository, CreateEmailHandler $createEmailHandler, EmailSentHandler $emailSentHandler)
    {
        $this->emailRepository = $emailRepository;
        $this->createEmailHandler = $createEmailHandler;
        $this->emailSentHandler = $emailSentHandler;
    }

    /**
     * @param User $user
     * @param string $template_name
     * @return Email
     */
    public function getNewEmailForUser(User $user, string $template_name):Email
    {
        $this->emailRepository->getNewEmailForUser($user, $template_name);
    }

    /**
     * @param User $user
     * @param string $template_name
     */
    public function createEmail(User $user, string $template_name):void
    {
        $this->createEmailHandler->handle($user, $template_name);
    }

    /**
     * @param Email $email
     */
    public function setEmailStatusSent(Email $email):void
    {
        $this->emailSentHandler->handle($email);
    }
}
