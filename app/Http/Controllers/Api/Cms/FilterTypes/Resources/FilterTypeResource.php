<?php

namespace App\Http\Controllers\Api\Cms\FilterTypes\Resources;

use App\Services\FilterTypes\FilterTypesService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterTypeResource extends JsonResource
{

    private function getFilterTypeService() : FilterTypesService
    {
        return app()->make(FilterTypesService::class);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request )
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
