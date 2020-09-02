<?php

namespace App\Http\Controllers\Api\Cms\Films\Resources;

class FilmWithCommentsCountResource extends FilmResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['comments_count'] = $this->comments()->count();

        return $data;
    }
}
