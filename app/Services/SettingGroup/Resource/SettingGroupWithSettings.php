<?php

namespace App\Services\SettingGroup\Resource;

use App\Services\Setting\Resource\Setting as SettingResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingGroupWithSettings extends JsonResource
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
            'alias' => $this->alias,
            'settings' => SettingResource::collection($this->whenLoaded('settings'))
        ];
    }
}
