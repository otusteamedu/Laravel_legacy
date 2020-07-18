<?php

namespace App\Services\Helpers;

use App\DTOs\IdDTO;
use Illuminate\Support\Collection;

/**
 * Class DTOHelper
 * @package App\Services\Helpers
 */
class DTOHelper
{
    /**
     * @param array $ids
     * @return Collection
     */
    public static function getIdsDTOFromArray(array $ids): Collection
    {
        return collect($ids)->map(function (int $id): IdDTO {
            return IdDTO::fromArray([IdDTO::ID => $id]);
        });
    }
}
