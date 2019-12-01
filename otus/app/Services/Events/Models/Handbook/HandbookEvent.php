<?php

namespace App\Services\Events\Models\Handbook;

use App\Models\Handbook;

class HandbookEvent {

    /** @var Handbook */
    private $handbook;

    public function __construct(Handbook $handbook) {
        $this->handbook = $handbook;
    }

    /**
     * @return Handbook
     */
    public function getHandbook(): Handbook {
        return $this->handbook;
    }
}
