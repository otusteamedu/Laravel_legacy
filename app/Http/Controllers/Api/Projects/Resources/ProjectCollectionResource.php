<?php

namespace App\Http\Controllers\Api\Projects\Resources;

use App\Http\Controllers\Api\Projects\Requests\ProjectListRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCollectionResource extends JsonResource
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
            'data' => ProjectResource::collection($this),
            'limit' => (int)$request->get('limit', ProjectListRequest::MAX_PER_PAGE),
            'offset' => (int)$request->get('offset', 0),
        ];
    }
}
