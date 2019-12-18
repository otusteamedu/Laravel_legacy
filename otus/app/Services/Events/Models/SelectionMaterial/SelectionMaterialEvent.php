<?php

namespace App\Services\Events\Models\SelectionMaterial;

use App\Models\SelectionMaterial;

class SelectionMaterialEvent {
    /** @var SelectionMaterial */
    private $selectionMaterial;

    public function __construct(SelectionMaterial $selectionMaterial) {
        $this->selectionMaterial = $selectionMaterial;
    }

    /**
     * @return SelectionMaterial
     */
    public function getSelectionMaterial(): SelectionMaterial {
        return $this->selectionMaterial;
    }
}
