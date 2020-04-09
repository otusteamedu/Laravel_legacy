<?php

namespace App\Services\Image\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageToEditor extends JsonResource
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
            'ratio' => $this->width / $this->height,
            'width' => $this->width,
            'height' => $this->height
        ];
    }
}
