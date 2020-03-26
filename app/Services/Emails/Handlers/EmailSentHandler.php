<?php


namespace App\Services\Emails\Handlers;

use App\Models\Email;
use App\Services\Emails\Repositories\EmailRepositoryInterface;

class EmailSentHandler
{
    private $emailRepository;

    public function __construct(EmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    /**
     * @param Email $email
     * @return void
     */
    public function handle(Email $email):void
    {
       $this->emailRepository->setEmailStatus($email, Email::STATUS_SENT);
    }
}
