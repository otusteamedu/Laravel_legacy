<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class Requests
{
    /**
     * Get formatted array of request headers
     *
     * @param  Request  $request
     *
     * @return Collection
     */
    public static function getRequestHeaders(Request $request): Collection
    {
        return collect($request->header())->transform(function ($item) {
            return $item[0];
        });
    }
}
