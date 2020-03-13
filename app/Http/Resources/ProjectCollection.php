<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'projects' => $this->collection,
        ];
    }
    public function with($request)
    {
        return [
            'meta' => 'test12',
            'otus' => '12345'
        ];
    }
}
