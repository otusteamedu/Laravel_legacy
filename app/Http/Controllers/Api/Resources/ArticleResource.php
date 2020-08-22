<?php

namespace App\Http\Controllers\Api\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'intro_text' => $this->body,
            'full_text' => $this->full_text,
            'published_at' => $this->published_at,
            'author' => $this->user_id,
            'image' => $this->image,
            'image_intro' => $this->image_intro
        ];
    }
}
