<?php


namespace App\Http\Listeners;


use Illuminate\Auth\Events\Failed;

class LogFailedLogin
{
    public function handle(Failed $event){
        \Log::info(self::class, [\Arr::except($event->credentials, 'password')]);
    }
}
