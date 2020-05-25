<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
           'style_id' => $this->style_id,
           'instructor_id' => $this->instructor_id,
           'instructor' => $this->instructor->name,
           'style' => $this->style->name,
           'days' => $this->days,
           'time' => $this->time

       ];
    }
}
