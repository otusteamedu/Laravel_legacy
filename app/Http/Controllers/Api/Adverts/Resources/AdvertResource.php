<?php

namespace App\Http\Controllers\Api\Adverts\Resources;

use App\Models\Advert;
use App\Http\Controllers\Api\Adverts\Request\AdvertsListRequest;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AdvertResource
 * @package App\Http\Controllers\Api\Adverts\Resources
 * @mixin Advert
 */
class AdvertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  AdvertsListRequest  $request
     * @return array
     */
    public function toArray($request)
    {
       return parent::toArray($request);
    }
}
