<?php


namespace App\Listeners;

use App\Models\User;
use App\Services\Events\Models\User\UserIsAdmin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class CheckUserIsAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event
     * @param Login $event
     */
    public function handle(Login $event)
    {
        // Access the logged in user
        $user = $event->user;
        Log::info("1. Только что залогинился ".$user->name);
        if($user->level == User::LEVEL_ADMIN)
        {
            Log::info("2. Да это администратор! ");
            event(new UserIsAdmin($user));
        }

    }
}
