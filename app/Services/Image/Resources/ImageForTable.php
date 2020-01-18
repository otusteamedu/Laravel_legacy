<?php

namespace App\Services\Image\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageForTable extends JsonResource
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
            'path' => $this->path,
            'topics' => $this->topics->modelKeys(),
            'colors' => $this->colors->modelKeys(),
            'interiors' => $this->interiors->modelKeys(),
            'tags' => $this->tags->modelKeys(),
            'format' => $this->format->title,
            'views' => $this->views,
            'likes' => $this->likes->count(),
            'orders' => $this->orders->count(),
            'publish' => $this->publish
        ];
    }
}
