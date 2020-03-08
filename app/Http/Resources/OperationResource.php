<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class OperationResource extends JsonResource
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
            'id' => $this->id,
            'sum' => $this->sum,
            'description' => $this->description,
            'category' => new CategoryResource($this->category),
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y'),
        ];
    }
}
