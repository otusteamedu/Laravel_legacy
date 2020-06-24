<?php


namespace App\Http\Controllers\Api\Cms\FilterTypes\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FilterTypesResource extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'filterTypes' => FilterTypeResource::collection($this),
        ];
}


}
