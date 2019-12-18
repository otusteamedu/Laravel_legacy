<?php

namespace App\Services\Events\Models\Favorite;

use App\Models\Favorite;

class FavoriteEvent {
    /** @var Favorite */
    private $favorite;

    public function __construct(Favorite $favorite) {
        $this->favorite = $favorite;
    }

    /**
     * @return Favorite
     */
    public function getFavorite(): Favorite {
        return $this->favorite;
    }
}
