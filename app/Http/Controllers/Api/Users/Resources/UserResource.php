<?php

namespace App\Http\Controllers\Api\Users\Resources;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Controllers\Api\Users\Resources
 */
class UserResource extends JsonResource
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
            'last_name' => $this->last_name,
            'name' => $this->name,
            'second_name' => $this->second_name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'role' => new RoleResource($this->whenLoaded('role')),
        ];
    }
}
