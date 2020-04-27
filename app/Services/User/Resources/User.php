<?php

namespace App\Services\User\Resources;

use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->roles->modelKeys()[0] ?? null,
//            'orders_count' => $this->orders()->count(),
            'publish' => $this->publish,
            'gravatar_small' => Gravatar::get($this->email, 'small-secure'),
            'gravatar_medium' => Gravatar::get($this->email, 'medium'),
            'created_at' => date('d-m-Y', strtotime($this->created_at))
        ];
    }
}
