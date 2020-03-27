<?php

namespace App\Services\User\Resources;

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
            'roles' => $this->roles->modelKeys(),
//            'orders_count' => $this->orders()->count(),
            'publish' => $this->publish,
            'created_at' => date('d-m-Y', strtotime($this->created_at))
        ];
    }
}
