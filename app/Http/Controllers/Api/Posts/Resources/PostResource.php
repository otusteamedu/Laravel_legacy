<?php

namespace App\Http\Controllers\Api\Posts\Resources;

use App\Http\Resources\GroupResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'user_id' => $this->user_id,
            'producer' => new UserResource($this->whenLoaded('producer')),
            'groups' => GroupResource::collection($this->whenLoaded('groups')),
        ];
    }
}
