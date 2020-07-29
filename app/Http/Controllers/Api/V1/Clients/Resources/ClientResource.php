<?php

namespace App\Http\Controllers\Api\V1\Clients\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'group_id'   => $this->group_id,
            'group_name' => $this->group->name,
            'name'       => $this->name,
            'email'      => $this->email,
            'balance'    => $this->balance,
            'created_at' => $this->created_at,
        ];
    }
}
