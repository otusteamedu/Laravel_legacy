<?php

namespace App\Services\Setting\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
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
            'display_name' => $this->display_name,
            'key_name' => $this->key_name,
            'value' => $this->value
        ];
    }
}
