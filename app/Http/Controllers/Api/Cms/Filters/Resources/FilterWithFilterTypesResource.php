<?php


namespace App\Http\Controllers\Api\Cms\Filters\Resources;

use App\Http\Controllers\Api\Cms\FilterTypes\Resources\FilterTypeResource;
use App\Http\Controllers\Api\Cms\FilterTypes\Resources\FilterTypesResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterWithFilterTypesResource  extends JsonResource
{


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'filters_count' => $this->filterTypes->count(),
            'filterTypes' => new FilterTypeResource($this->filterTypes)
        ];
    }
}
