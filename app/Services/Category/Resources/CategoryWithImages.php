<?php

namespace App\Services\Category\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWithImages extends JsonResource
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
            'images' => $this->images,
//            'images_count' => $this->images()->count(),
        ];
    }
}
