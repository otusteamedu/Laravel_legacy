<?php


namespace App\Http\Controllers\Api\Cms\Filters\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
//use App\Http\Controllers\Api\Cms\Filters\Resources\FilterResource;

class FiltersResource extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->count(),
            'filters' => FilterResource::collection($this),
        ];
}
    public function with($request)
    {
        return [
            'added_attribute' => 'Add something global from FiltersResource',
        ];
    }

    public function withResponse($request, $response)
    {
        // Add custom header to response
        $response->header('X-Value', 'True');
    }

}
