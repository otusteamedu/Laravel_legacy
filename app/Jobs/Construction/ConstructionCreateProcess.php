<?php

namespace App\Jobs\Construction;


use App\Models\User;

use App\Services\Constructions\ConstructionsService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ConstructionCreateProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var User */

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;

    }

    public function handle(ConstructionsService $constructionsService)
    {
        $constructionsService->createConstruction($this->data);
    }

}
