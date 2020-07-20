<?php

namespace App\Listeners;



use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\Construction\ConstructionCreateProcessEvent;

class ConstructionCreateLogListener implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function handle(ConstructionCreateProcessEvent  $event)
    {
        info('Пользователь создал запись',$event->data);
    }
}
