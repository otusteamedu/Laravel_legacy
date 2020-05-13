<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StyleResource extends JsonResource
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
           'style_id' => $this->style_id,
           'name' => $this->name
       ];
    }
}
