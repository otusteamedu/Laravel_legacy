<?php

namespace App\Listeners;

use App\Events\OperationSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\StoreOperation;

class OperationSavedNotification
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
     * Handle the event.
     *
     * @param  OperationSaved  $event
     * @return void
     */
    public function handle(OperationSaved $event)
    {
        log::info('Сработало событие сохранение операции.');
    }
}
