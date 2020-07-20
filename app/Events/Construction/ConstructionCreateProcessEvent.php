<?php

namespace App\Events\Construction;

use Illuminate\Queue\SerializesModels;

class ConstructionCreateProcessEvent
{
    use SerializesModels;

    public $data;

    public function __construct(array $data)
    {

        $this->data = $data;;
    }
}
