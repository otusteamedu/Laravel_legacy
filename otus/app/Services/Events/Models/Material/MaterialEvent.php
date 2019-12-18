<?php

namespace App\Services\Events\Models\Material;

use App\Models\Material;

class MaterialEvent {

    /** @var Material */
    private $material;

    public function __construct(Material $material) {
        $this->material = $material;
    }

    /**
     * @return Material
     */
    public function getMaterial(): Material {
        return $this->material;
    }
}
