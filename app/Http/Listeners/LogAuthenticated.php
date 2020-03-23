<?php


namespace App\Http\Listeners;


use Illuminate\Auth\Events\Authenticated;

class LogAuthenticated
{
    public function handle(Authenticated $event){
        \Log::info(self::class, [$event->user->getAuthIdentifier()]);
    }
}
