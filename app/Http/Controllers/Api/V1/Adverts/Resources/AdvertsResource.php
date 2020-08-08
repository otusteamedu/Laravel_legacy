<?php

namespace App\Http\Controllers\Api\V1\Adverts\Resources;

use App\Http\Controllers\Api\V1\Adverts\Request\AdvertsListRequest;
use App\Models\Advert;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;


class AdvertsResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  AdvertsListRequest  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
         'data' => AdvertResource::collection($this),
         //'limit' => $request->get('limit'),
//         'token' => Str::random(80),
       ];
    }
}
