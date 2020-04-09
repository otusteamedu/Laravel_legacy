<?php

namespace App\Services\Tag\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagToFilter extends JsonResource
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
            'title' => $this->title,
            'image_count' => $this->images->count()
        ];
    }
}
