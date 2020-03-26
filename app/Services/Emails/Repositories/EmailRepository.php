<?php


namespace App\Services\Emails\Repositories;


use App\Models\Email;
use App\Models\User;

class EmailRepository implements EmailRepositoryInterface
{

  /**
   * @inheritDoc
   */
  public function getNewEmailForUser(User $user, string $template_name): Email
  {
     $email = $user->emails()
                   ->where('template', $template_name)
                   ->where('status', Email::STATUS_NEW)
                   ->first();
     return $email;
  }

  /**
   * @inheritDoc
   */
  public function setEmailStatus(Email $email, int $status): void
  {
     $email->status = $status;
     $email->save();
  }
}
