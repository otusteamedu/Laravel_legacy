<?php

namespace App\Services\Events\Models\Compilation;

use App\Models\Compilation;

class CompilationEvent {
    /** @var Compilation */
    private $compilation;

    public function __construct(Compilation $compilation) {
        $this->compilation = $compilation;
    }

    /**
     * @return Compilation
     */
    public function getCompilation(): Compilation {
        return $this->compilation;
    }
}
