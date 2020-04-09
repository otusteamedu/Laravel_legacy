<?php

namespace App\Services\Image\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageToClient extends JsonResource
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
            'article' => str_pad($this->id, 5, "0", STR_PAD_LEFT),
            'path' => $this->path,
            'format' => $this->format->title,
            'views' => $this->views,
            'likes' => $this->likes->count(),
            'ratio' => $this->width / $this->height
        ];
    }
}
