<?php

namespace App\Http\Controllers\Api\Cms\Films\Resources;

class FilmWithCommentsResource extends FilmResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $comments = $this->comments;
        $commentsData = [];
        foreach ($comments as $comment) {
            $commentData[] = $comment->toArray();
        }
        $data['comments'] = $commentsData;

        return $data;
    }
}
