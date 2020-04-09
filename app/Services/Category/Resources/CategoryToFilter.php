<?php

namespace App\Services\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryToFilter extends JsonResource
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
            'type' => $this->type,
            'title' => $this->title,
            'alias' => $this->alias,
            'image_path' => $this->image_path,
            'image_count' => $this->images->count()
        ];
    }
}
