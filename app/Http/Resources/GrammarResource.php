<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GrammarResource extends JsonResource
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
            'name' => $this->name,
            'title' => $this->title,
            'code' => $this->code,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description,
            'grammar_text' => $this->grammar_text,
            'arabic_text' => $this->arabic_text,
        ];
    }
}
