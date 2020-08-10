<?php

namespace App\Http\Controllers\Api\Posts\Resources;

use App\Http\Controllers\Api\Users\Resources\UserResource;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PostResource
 * @package App\Http\Controllers\Api\Posts\Resources
 */
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'published_at' => $this->published_at ? $this->published_at->format('Y-m-d H:i:s') : null,
            'user_id' => $this->user_id,
            'producer' => new UserResource($this->whenLoaded('producer')),
            'groups' => GroupResource::collection($this->whenLoaded('groups')),
        ];
    }
}
