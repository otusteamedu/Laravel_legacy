<?php

namespace App\Mail\ProjectTasks;

use App\Models\ProjectTask;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FinishedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var ProjectTask
     */
    private $projectTask;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param ProjectTask $projectTask
     * @param User        $user
     */
    public function __construct(ProjectTask $projectTask, User $user)
    {
        $this->projectTask = $projectTask;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.projectTasks.finished');
    }
}
