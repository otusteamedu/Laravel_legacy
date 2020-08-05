<?php

namespace App\Http\Controllers\Api\V1\Clients\Resources;

use App\Http\Controllers\Api\V1\Clients\Requests\ClientListRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ClientResource::collection($this),
            'limit' => (int)$request->get('limit', ClientListRequest::MAX_PER_PAGE),
            'offset' => (int)$request->get('offset', 0),
        ];
    }
}
