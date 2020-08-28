<?php

namespace App\Http\Controllers\Api\Cms\Films\Resources;


use App\Http\Controllers\Api\Cms\Films\Requests\FilmsListRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FilmsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  FilmsListRequest  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => FilmResource::collection($this),
            'count' => $this->count(),
            'limit' => (int) $request->get('limit', FilmsListRequest::MAX_PER_PAGE),
        ];
    }
}
